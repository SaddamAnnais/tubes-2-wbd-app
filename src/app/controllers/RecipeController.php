<?php

class RecipeController extends Controller implements ControllerInterface {
    public function index() {
        // TODO: Ganti sama 404
        echo '<div>404 not found</div>';

        exit;
    }

    public function watch($params) // params: recipe_id
    {
        try {
            $recipe_id = (int) $params;
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET': // get video
                    $auth_middleware = $this->middleware('Auth');
                    $auth_middleware->isAuthenticated();
                    $is_admin = (bool) $auth_middleware->is_admin;

                    // Get data from db
                    $recipe_model = $this->model('RecipeModel');
                    $recipe = $recipe_model->getRecipeById($recipe_id);

                    if (!$recipe)
                    {
                        $recipe_data = [];
                    } else {
                        $recipe_data = [
                            'recipe_id' => $recipe->recipe_id,
                            'title' => $recipe->title,
                            'desc' => $recipe->desc,
                            'tag' => $recipe->tag,
                            'difficulty' => $recipe->difficulty,
                            'video_path' => $recipe->video_path,
                            'duration' => $recipe->duration,
                            'image_path' => $recipe->image_path,
                            'created_at' => $recipe->created_at
                        ];
                    }

                    // Admin vs user view
                    if ($is_admin) {
                        // TODO: admin view (ada tombol edit dan hapus) + render
                        // $watchRecipeView = $this->view(...);
                        echo 'Watch recipe for admin<br/>';
                    } else {
                        // TODO: user view
                        // $watchRecipeView = $this->view(...);
                        echo 'Watch recipe for user<br/>';
                    }

                    // $watchRecipeView->render();

                    exit;

                case 'POST': // edit
                    /*  REQUEST BODY
                        {
                            "title":
                            "desc":
                            "tag":
                            "difficulty":
                            "video": [file]
                            "image": [file]
                            "prev_video_path":
                            "prev_image_path":
                        }
                    */

                    // ADMIN ONLY
                    $auth_middleware = $this->middleware('Auth');
                    $auth_middleware->isAdmin();

                    // Check request body
                    if (!($_POST['title'] && $_POST['desc'] && $_POST['tag'] && $_POST['difficulty'] && isset($_POST['prev_video_path']) && isset($_POST['prev_image_path'])))
                    {
                        throw new DisplayedException(400, "Recipe title, description, tag, difficulty, prev image path, prev video path cannot be empty.");
                    }

                    // Check files errors
                    $video_error = $_FILES['video']['error'];
                    $image_error = $_FILES['image']['error'];
                    if ($video_error == 1 || $video_error == 2 || $image_error == 1 || $image_error == 2) {
                        throw new DisplayedException(400, "Video or image size is too big.");
                    }

                    if ($video_error == 4 || $image_error == 4) {
                        throw new DisplayedException(400, "No recipe video or image uploaded.");
                    }

                    if ($video_error !== 0 || $video_error !== 3 || $image_error !== 0 || $image_error !== 3) {
                        throw new DisplayedException(500);
                    }

                    $video_storage = new Storage('video');
                    $image_storage = new Storage('image');

                    $uploaded_video = $video_storage->uploadVideo($_FILES['video']['tmp_name']);
                    $duration = $video_storage->getVideoDurationSeconds($uploaded_video);

                    $uploaded_image = $image_storage->uploadImage($_FILES['image']['tmp_name']);

                    $data = [
                        'title' => $_POST['title'],
                        'desc' => $_POST['desc'],
                        'tag' => $_POST['tag'],
                        'difficulty' => $_POST['difficulty'],
                        'video_path' => $uploaded_video,
                        'image_path' => $uploaded_image,
                        'duration' => $duration
                    ];

                    $recipe_model = $this->model('RecipeModel');
                    $recipe_model->updateRecipeById($recipe_id, $data);

                    $video_storage->deleteFile($_POST['prev_video_path']);
                    $image_storage->deleteFile($_POST['prev_image_path']);

                    // Refresh page watch
                    header("Location: /public/recipe/watch/$recipe_id", true, 301);

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function add()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST': // add new recipe
                    /*  REQUEST BODY
                        {
                            "title":
                            "desc":
                            "tag":
                            "difficulty":
                            "video": [file]
                            "image": [file]
                        }
                    */

                    // ADMIN ONLY
                    $auth_middleware = $this->middleware('Auth');
                    $auth_middleware->isAdmin();

                    // Check request body
                    if (!($_POST['title'] && $_POST['desc'] && $_POST['tag'] && $_POST['difficulty']))
                    {
                        throw new DisplayedException(400, "Recipe title, description, tag, difficulty cannot be empty.");
                    }

                    // Check files
                    $video_error = $_FILES['video']['error'];
                    $image_error = $_FILES['image']['error'];

                    if ($video_error == 1 || $video_error == 2 || $image_error == 1 || $image_error == 2) {
                        throw new DisplayedException(400, "Video or image size is too big.");
                    }

                    if ($video_error == 4 || $image_error == 4) {
                        throw new DisplayedException(400, "No recipe video or image uploaded.");
                    }

                    if ($video_error !== 0 || $video_error !== 3 || $image_error !== 0 || $image_error !== 3) {
                        throw new DisplayedException(500);
                    }

                    $video_storage = new Storage('video');
                    $image_storage = new Storage('image');

                    $uploaded_video = $video_storage->uploadVideo($_FILES['video']['tmp_name']);
                    $duration = $video_storage->getVideoDurationSeconds($uploaded_video);

                    $uploaded_image = $image_storage->uploadImage($_FILES['image']['tmp_name']);

                    $data = [
                        'title' => $_POST['title'],
                        'desc' => $_POST['desc'],
                        'tag' => $_POST['tag'],
                        'difficulty' => $_POST['difficulty'],
                        'video_path' => $uploaded_video,
                        'image_path' => $uploaded_image,
                        'duration' => $duration
                    ];

                    $recipe_model = $this->model('RecipeModel');
                    $recipe_model->addRecipe($data);

                    // TODO: go to root?

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function addtoplaylist()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST': // edit
                    /*  REQUEST BODY
                        {
                            "recipe_id" :
                            "playlist_id" :
                        }
                    */

                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAuthenticated();

                    if (!isset($_POST['recipe_id']) || !isset($_POST['playlist_id'])) {
                        throw new DisplayedException(400, "No playlist id or recipe id specified.");
                    }

                    $playlist_model = $this->model('PlaylistModel');
                    $playlist_model->addToPlaylist($_POST['playlist_id'], $_POST['recipe_id']);

                    // TODO: tampilin notice berhasil di /public/recipe/watch/$recipe_id

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function delete($params) // params: recipe_id
    {
        try {
            $recipe_id = (int) $params;

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST': // delete
                    /*  REQUEST BODY
                        {
                            "prev_video_path":
                            "prev_image_path":
                        }
                    */

                    // ADMIN ONLY
                    $auth_middleware = $this->middleware('Auth');
                    $auth_middleware->isAdmin();


                    // Check request body
                    if (!isset($_POST['prev_video_path']) || !isset($_POST['prev_image_path'])) {
                        throw new DisplayedException(400, "Prev image and video paths are not set.");
                    }

                    $recipe_model = $this->model('RecipeModel');
                    $recipe_model->deleteRecipe($recipe_id);

                    $video_storage = new Storage('video');
                    $image_storage = new Storage('image');

                    $video_storage->deleteFile($_POST['prev_video_path']);
                    $image_storage->deleteFile($_POST['prev_image_path']);

                    header("Location: /public/home/", true, 301);

                    // Back to home page
                    header('Content-Type: application/json');
                    echo json_encode(["redirect_url" => "/public/home"]);

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
}
