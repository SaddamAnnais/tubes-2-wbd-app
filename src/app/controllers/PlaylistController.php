<?php

class PlaylistController extends Controller implements ControllerInterface {
    public function index() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $user_id = $user->user_id;

                    $playlist_model = $this->model('PlaylistModel');
                    $playlists = $playlist_model->getPlaylistsByOwner($user_id);
                    $data = [
                        "user_id" => $user_id,
                        "playlists" => $playlists
                    ];

                    $playlistsView = $this->view('playlist', 'Playlists', $data);
                    $playlistsView->render();

                    exit;
                case 'POST':
                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $user_id = $user->user_id;

                    if (!isset($_POST['title'])) {
                        throw new DisplayedException(400, "Playlist title cannot be empty,");
                    }

                    $playlist_model = $this->model('PlaylistModel');
                    $data = [
                        'user_id' => $user_id,
                        'title' => $_POST['title']
                    ];

                    $playlist_model->createPlaylist($data);

                    http_response_code(201);
                    header('Content-Type: application/json');
                    echo json_encode(["url" => BASE_URL . "/playlist"]);

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                /* Unauthorized */
                $unauthView = $this->view('exception', 'Unauthorized');
                $unauthView->render();
            }
            http_response_code($e->getCode());
            exit;
        }
    }

    public function list($params) // params: playlist_id
    {
        try {
            $playlist_id = (int) $params;
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':

                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $is_admin = (bool) $user->is_admin;

                    // Get data from db
                    $playlist_model = $this->model('PlaylistModel');
                    $playlist = $playlist_model->getPlaylistById($playlist_id);

                    $recipes = $playlist_model->fetchAllRecipe($playlist_id);

                    // print_r($playlist);
                    // print_r($recipes);

                    if (!$playlist)
                    {
                        $playlist_data = [];
                    } else {
                        $user_model = $this->model('UserModel');
                        $owner = $user_model->getUserById($playlist->user_id);

                        $playlist_data = [
                            'playlist_id' => $playlist->playlist_id,
                            'title' => $playlist->title,
                            'owner' => $owner,
                            'cover' => $playlist->cover,
                            'created_at' => $playlist->created_at,
                            'total_recipe' => $playlist->total_recipe,
                            'recipes' => $recipes
                        ];
                    }

                    // Admin vs user view
                    if ($is_admin) {
                        // TODO: admin view (ada tombol edit dan hapus) + render
                        // $watchRecipeView = $this->view(...);
                        $listPlaylistView = $this->view("playlist", "playlist", $playlist_data);
                    } else {
                        // TODO: user view
                        // $watchRecipeView = $this->view(...);
                        $listPlaylistView = $this->view("playlist", "playlist", $playlist_data);
                    }

                    $listPlaylistView->render();

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                /* Unauthorized */
                $unauthView = $this->view('exception', 'Unauthorized');
                $unauthView->render();
            }
            http_response_code($e->getCode());
            exit;
        }
    }
}
