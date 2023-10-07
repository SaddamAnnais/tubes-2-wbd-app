<?php

class PlaylistController extends Controller implements ControllerInterface {
    public function index() {
        // empty param
        $not_exists_view = $this->view('exception', 'NotFound');
        $not_exists_view->render();
    }

    public function list($params) // params: playlist_id
    {
        try {
            $playlist_id = (int) $params;
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET': 
                    
                    // $auth_middleware = $this->middleware('Auth');
                    // $auth_middleware->isAuthenticated();
                    // $is_admin = (bool) $auth_middleware->is_admin;
                    $is_admin = true;

                    // Get data from db
                    $playlist_model = $this->model('PlaylistModel');
                    $playlist = $playlist_model->getPlaylistById($playlist_id);

                    if (!$playlist)
                    {
                        $playlist_data = [];
                    } else {
                        $playlist_data = [
                            'playlist_id' => $playlist->playlist_id,
                            'title' => $playlist->title,
                            'user_id' => $playlist->user_id,
                            'created_at' => $playlist->created_at,
                            'total_recipe' => $playlist->total_recipe
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
            http_response_code($e->getCode());
            exit;
        }
    }
}
