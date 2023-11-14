<?php

class CreatorController extends Controller implements ControllerInterface
{
    public function index() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $user_id = $user->user_id;

                    // TODO: Get data from REST, check using user_id

                    $data = [
                        'user_id' => $user_id,
                        'creators' => [
                            [
                                'id' => 1,
                                'name' => 'Creator 1',
                                'username' => 'username1',
                                'subs_status' => "no"
                            ],
                            [
                                'id' => 2,
                                'name' => 'Creator 2',
                                'username' => 'username2',
                                'subs_status' => "yes"
                            ],
                            [
                                'id' => 3,
                                'name' => 'Creator 3',
                                'username' => 'username3',
                                'subs_status' => "waiting"
                            ],
                            [
                                'id' => 4,
                                'name' => 'Creator 4',
                                'username' => 'username4',
                                'subs_status' => "no"
                            ],
                            [
                                'id' => 5,
                                'name' => 'Creator 5',
                                'username' => 'username5',
                                'subs_status' => "no"
                            ],
                        ]
                    ];

                    $viewResult = $this->view("creator", "CreatorList", $data);

                    $viewResult->render();

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function subscribe() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $user_id = $user->user_id;

                    if (!isset($_POST['creator_id']) || !isset($_POST['email'])) {
                        throw new DisplayedException(400, "creator_id and email cannot be empty,");
                    }

                    // TODO: Send Request to SOAP

                    http_response_code(201);
                    header('Content-Type: application/json');
                    echo json_encode(["url" => BASE_URL . "/creator"]);

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
