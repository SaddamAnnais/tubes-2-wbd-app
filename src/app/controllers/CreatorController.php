<?php

class CreatorController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $user_id = $user->user_id;

                    $url = REST_URL . '/pro/creator';
                    $headers = ['Content-Type: application/json', 'x-api-key: ' . REST_KEY];
                    
                    $queryParams = http_build_query(["requesterID" => $user_id]);
                    
                    $ch = curl_init($url . '?' . $queryParams);
                    curl_setopt_array($ch, [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => $headers,
                    ]);
                    
                    $response = curl_exec($ch);
                    $arrayResponse = json_decode($response, true);
                    // print_r($arrayResponse);
                    $data = ['user_id' => $user_id, 'creators' => $arrayResponse['data']];

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

    public function subscribe()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $user_id = $user->user_id;

                    if (!isset($_POST['creator_id']) || !isset($_POST['email'])) {
                        throw new DisplayedException(400, "creator_id and email cannot be empty,");
                    }

                    $requestXml = '
                    <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
                        <Body>
                            <create xmlns="http://service.cooklyst/">
                                <arg0 xmlns="">php</arg0>
                                <arg1 xmlns="">' . $_POST['creator_id'] . '</arg1>
                                <arg2 xmlns="">' . $user_id . '</arg2>
                                <arg3 xmlns="">' . $_POST['email'] . '</arg3>
                            </create>
                        </Body>
                    </Envelope>
                    ';

                    // cURL options
                    $options = array(
                        CURLOPT_URL => "http://cooklyst-soap-service:8001/api/subscribe", // Replace with the actual SOAP endpoint URL
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $requestXml,
                        CURLOPT_HTTPHEADER => array(
                            "Content-type: text/xml;charset=\"utf-8\"",
                            "Accept: text/xml",
                            "Cache-Control: no-cache",
                            "Pragma: no-cache",
                            "SOAPAction: \"run\"",
                            "Content-length: " . strlen($requestXml),
                        ),
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_CONNECTTIMEOUT => 10,
                        CURLOPT_TIMEOUT => 10,

                    );

                    // Initialize cURL
                    $curl = curl_init();
                    curl_setopt_array($curl, $options);
                    $response = curl_exec($curl);
                    if ($response === false) {
                        $err = 'Curl error: ' . curl_error($curl);
                        print $err;
                    } else {
                        curl_close($curl);
                        // print $response;
                        http_response_code(201);
                    }

                    exit;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function collection($creatorId, $collectionId = null)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                // bercabang jadi 2 antara yang punya collectionId atau engga
                // gapunya collectionId -> nampilin semua colections yang di-subscribe oleh user
                // punya collectionId -> nampilin semua recipe dalam collection dengan id tsb

                case 'GET':
                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $user_id = $user->user_id;

                    $curl = curl_init();
                    // FETCH DATA
                    if (is_null($collectionId)) {
                        // no collectionId -> fetch all the collection that the creator Id have
                        $url = REST_URL . '/pro/creator/' . $creatorId . '/collection';
                        $headers = ['Content-Type: application/json', 'x-api-key: ' . REST_KEY];
                        
                        $queryParams = http_build_query(["requesterID" => $user_id]);
                        
                        $ch = curl_init($url . '?' . $queryParams);
                        curl_setopt_array($ch, [
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_HTTPHEADER => $headers,
                        ]);
                        
                        $response = curl_exec($ch);
                        $arrayResponse = json_decode($response);

                        if ($e = curl_error($curl)) {
                            echo $e;
                        } else {
                            $viewResult = $this->view("creator", "CollectionList", $arrayResponse->data);
                            $viewResult->render();
                        }

                    } else {
                        // collectionId -> fetch all the collection that the creator Id have

                        // $response will be
                        // creator_name
                        // title
                        // cover
                        // total_recipe
                        // created_at
                        // an array of
                        // - recipe_id,
                        // - duration (in seconds)
                        // - cover
                        // - title
                        // - created_at

                        // EXAMPLE OF FETCHING
                        $curl = curl_init();
                        // $url = "https://dummyjson.com/quotes/" . creatorId;
                        // curl_setopt($curl, CURLOPT_URL, $url);
                        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        // $resp = curl_exec($curl);

                        // $data = json_decode($resp);
                        $data = (object) [
                            'creator_name' => "Pak Gembus",
                            'title' => 'Sea Shore',
                            'cover' => "",
                            'total_recipe' => 10,
                            'created_at' => date('Y-m-d H:i:s'),
                            'recipes' => [
                                (object) [
                                    'recipe_id' => 1,
                                    'duration' => 110,
                                    'title' => 'test title',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'cover' => ""
                                ]
                            ],
                        ];

                        if ($e = curl_error($curl)) {
                            echo $e;
                        } else {
                            $viewResult = $this->view("creator", "CollectionRecipe", $data);
                            $viewResult->render();
                        }
                    }
                    break;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function watch($recipeId)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {

                case 'GET':
                    $auth_middleware = $this->middleware('Auth');
                    $user = $auth_middleware->isAuthenticated();
                    $user_id = $user->user_id;

                    $curl = curl_init();
                    // FETCH DATA

                    // $response will be
                    // recipe_id
                    // title
                    // is_admin
                    // encoded_video
                    // desc
                    // tag
                    // difficulty

                    // EXAMPLE OF FETCHING
                    $curl = curl_init();
                    // $url = "https://dummyjson.com/quotes/" . $recipeId;
                    // curl_setopt($curl, CURLOPT_URL, $url);
                    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    // $resp = curl_exec($curl);

                    // $data = json_decode($resp);
                    $data = (object) [
                        'recipe_id' => 1,
                        'title' => "Test Title",
                        "encoded_video" => "asd",
                        "desc" => "this is description",
                        "tag" => "american",
                        "difficulty" => "medium",
                        "created_at" => date('Y-m-d H:i:s')
                    ];

                    if ($e = curl_error($curl)) {
                        echo $e;
                    } else {
                        $viewResult = $this->view("creator", "WatchRecipeByCreator", $data);
                        $viewResult->render();
                    }
                    break;
                default:
                    throw new DisplayedException(405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
