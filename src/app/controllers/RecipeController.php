<?php

class RecipeController extends Controller implements ControllerInterface {
    public function index() {
        $not_exists_view = $this->view('exception', 'NotFound');
        $not_exists_view->render();
    }

    public function watch($params) // params: recipe_id
    {
        try {
            $recipe_id = (int) $params;
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET': // get video
                    // echo 'Watch recipe';
                    // exit;

                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $is_admin = (bool) $user->is_admin;

                    // Get data from db
                    $recipe_model = $this->model('RecipeModel');
                    $recipe = $recipe_model->getRecipeById($recipe_id);

                    // get user playlists
                    $playlist_model = $this->model('PlaylistModel');
                    $playlist = $playlist_model->getPlaylistsByOwner($user->user_id);

                    if (!$recipe)
                    {
                        $recipe_data = [];
                    } else {
                        $formatted_date = new DateTime($recipe->created_at);
                        $formatted_date = $formatted_date->format('D, d M Y');

                        $recipe_data = [
                            'recipe_id' => $recipe->recipe_id,
                            'title' => $recipe->title,
                            'desc' => $recipe->desc,
                            'tag' => $recipe->tag,
                            'difficulty' => $recipe->difficulty,
                            'video_path' => $recipe->video_path,
                            'duration' => $recipe->duration,
                            'image_path' => $recipe->image_path,
                            'created_at' => $formatted_date,
                            'is_admin' => $is_admin,
                            'playlist' => $playlist
                        ];
                    }

                    $watchRecipeView = $this->view('recipe', 'WatchRecipe', $recipe_data);
                    $watchRecipeView->render();

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function edit($params) { // params: recipe_id
        try {
            $recipe_id = (int) $params;
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // ADMIN ONLY
                    $auth_middleware = $this->middleware('Auth');
                    $auth_middleware->isAdmin();

                    $recipe_model = $this->model('RecipeModel');
                    $recipe = $recipe_model->getRecipeById($recipe_id);

                    $formatted_date = new DateTime($recipe->created_at);
                    $formatted_date = $formatted_date->format('D, d M Y');

                    $recipe_data = [
                        'recipe_id' => $recipe->recipe_id,
                        'title' => $recipe->title,
                        'desc' => $recipe->desc,
                        'tag' => $recipe->tag,
                        'difficulty' => $recipe->difficulty,
                        'video_path' => $recipe->video_path,
                        'duration' => $recipe->duration,
                        'image_path' => $recipe->image_path,
                        'created_at' => $formatted_date
                    ];

                    $editRecipeView = $this->view('recipe', 'EditRecipe', $recipe_data);
                    $editRecipeView->render();

                    exit;
                case 'POST':
                    /*  REQUEST BODY
                        {
                            "title":
                            "desc":
                            "tag":
                            "difficulty":
                            "video": [file, if video want to be changed]
                            "image": [file, if image want to be changed]
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

                    // Get image and video path
                    $recipe_model = $this->model('RecipeModel');
                    $recipe = $recipe_model->getRecipeById($recipe_id);
                    $curr_image_path = $recipe->image_path;
                    $curr_video_path = $recipe->video_path;
                    $curr_duration = $recipe->duration;

                    // Check if video is going to be changed
                    if (isset($_FILES['video'])) {
                        $video_error = $_FILES['video']['error'];
                        //
                        if ($video_error == 0) {
                            $video_storage = new Storage('video');
                            $uploaded_video = $video_storage->uploadVideo($_FILES['video']['tmp_name']);
                            $duration = $video_storage->getVideoDurationSeconds($uploaded_video);
                            $video_storage->deleteFile($curr_video_path);
                            $curr_video_path = $uploaded_video;
                            $curr_duration = $duration;
                        }
                    }

                    // Check if image is going to be changed
                    if (isset($_FILES['image'])) {
                        $image_error = $_FILES['image']['error'];
                        if ($image_error == 0) {
                            $image_storage = new Storage('image');
                            $uploaded_image = $image_storage->uploadImage($_FILES['image']['tmp_name']);
                            $image_storage->deleteFile($curr_image_path);
                            $curr_image_path = $uploaded_image;
                        }
                    }

                    $data = [
                        'title' => $_POST['title'],
                        'desc' => $_POST['desc'],
                        'tag' => $_POST['tag'],
                        'difficulty' => $_POST['difficulty'],
                        'video_path' => $curr_video_path,
                        'image_path' => $curr_image_path,
                        'duration' => $curr_duration
                    ];

                    $recipe_model->updateRecipeById($recipe_id, $data);

                    http_response_code(201);

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
                case 'GET':
                    // ADMIN ONLY
                    $auth_middleware = $this->middleware('Auth');
                    $auth_middleware->isAdmin();

                    $addRecipeView = $this->view('recipe', 'AddRecipe');
                    $addRecipeView->render();

                    exit;
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

                    if (!(($video_error == 0 || $video_error == 3) && ($image_error == 0 || $image_error == 3))) {
                        throw new DisplayedException(500, $video_error . " " . $image_error);
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

                    http_response_code(201);

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

                    $authMiddleware = $this->middleware('Auth');
                    $authMiddleware->isAdmin();

                    if (!isset($_POST['recipe_id']) || !isset($_POST['playlist_id'])) {
                        throw new DisplayedException(400, "No playlist id or recipe id specified.");
                    }

                    $playlist_model = $this->model('PlaylistModel');
                    $playlist_model->addToPlaylist($_POST['playlist_id'], $_POST['recipe_id']);

                    http_response_code(201);

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
                        }
                    */

                    // ADMIN ONLY
                    $auth_middleware = $this->middleware('Auth');
                    $auth_middleware->isAdmin();


                    $recipe_model = $this->model('RecipeModel');

                    // Get image and video path
                    $recipe = $recipe_model->getRecipeById($recipe_id);
                    $prev_image_path = $recipe->image_path;
                    $prev_video_path = $recipe->video_path;


                    $recipe_model->deleteRecipe($recipe_id);

                    $video_storage = new Storage('video');
                    $image_storage = new Storage('image');

                    $video_storage->deleteFile($prev_video_path);
                    $image_storage->deleteFile($prev_image_path);

                    http_response_code(201);

                    // Back to home page
                    header('Content-Type: application/json');
                    echo json_encode(["url" => BASE_URL . "/home"]);

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
