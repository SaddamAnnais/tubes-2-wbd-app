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
                    // $data = ['user_id' => $user_id, 'creators' => []];
                    // print_r($data);
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
                        $url = REST_URL . '/pro/collection/' . $collectionId . '/recipes';
                        $headers = ['Content-Type: application/json', 'x-api-key: ' . REST_KEY];

                        $queryParams = http_build_query(["requesterID" => $user_id]);

                        $ch = curl_init($url . '?' . $queryParams);
                        curl_setopt_array($ch, [
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_HTTPHEADER => $headers,
                        ]);

                        $response = curl_exec($ch);
                        $arrayResponse = json_decode($response);

                        $response = curl_exec($ch);
                        $arrayResponse = json_decode($response);

                        if ($e = curl_error($curl)) {
                            echo $e;
                        } else {
                            $viewResult = $this->view("creator", "CollectionRecipe", $arrayResponse->data);
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

                    // the details
                    $url = REST_URL . '/pro/recipe/' . $recipeId;
                    $headers = ['Content-Type: application/json', 'x-api-key: ' . REST_KEY];

                    $queryParams = http_build_query(["requesterID" => $user_id]);

                    $ch = curl_init($url . '?' . $queryParams);
                    curl_setopt_array($ch, [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => $headers,
                    ]);

                    $response = curl_exec($ch);
                    $arrayResponse = json_decode($response);


                    // the videos                    
                    $url_video = REST_URL . '/pro/recipe/' . $recipeId . "/video" . "?" . $queryParams;
                    $headers = [
                        'http' => [
                            'header' => 'x-api-key: ' . REST_KEY
                        ]
                    ];
                    $ch_url = curl_init();

                    curl_setopt($ch_url, CURLOPT_URL, $url_video);
                    curl_setopt($ch_url, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch_url, CURLOPT_HTTPHEADER, array(
                        'x-api-key: ' . REST_KEY
                    ));
                    $response = curl_exec($ch);
                    $base64Video = base64_encode($response);
                    // echo $base64Video;
                    $arrayResponse->data->encoded_video = $base64Video;

                    if ($e = curl_error($ch)) {
                        echo $e;
                    } else {
                        $viewResult = $this->view("creator", "WatchRecipeByCreator", $arrayResponse->data);
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
