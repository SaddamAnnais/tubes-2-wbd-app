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
                    $is_admin = $auth_middleware->is_admin();

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

                    if ($is_admin) {
                        // TODO: admin view (ada tombol edit dan hapus)
                        echo 'Watch recipe for admin<br/>';
                    } else {
                        // TODO: user view
                        echo 'Watch recipe for user<br/>';
                    }

                    exit;

                case 'POST': // edit
                    // ADMIN ONLY
                    $auth_middleware = $this->middleware('Auth');
                    $auth_middleware->isAdmin();

                    if (!($_POST['title'] && $_POST['desc'] && $_POST['tag'] && $_POST['difficulty']))
                    {
                        throw new DisplayedException(400, "Recipe title, description, tag, and difficulty cannot be empty.");
                    }

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
                    // TODO: implement

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
                    // TODO: implement

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
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST': // delete
                    // TODO: implement

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
