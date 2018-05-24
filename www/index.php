<?php
require 'vendor/autoload.php';
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$signer = new Sha256();


if (isset($_GET['token'])) {
    $token = (new Parser())->parse((string)$_GET['token']);
    $data = new ValidationData();
    try {
        if ($token->validate($data) && $token->verify($signer, getenv('JWT_KEY'))) {

          $point = json_decode($_GET['points']);

           $data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=".urlencode($point->a)."&destinations=".urlencode($point->b)."&language=ru-RU&sensor=false");
           $result = new stdClass();
           $result = json_decode($data);
           $result->rows[0]->elements[0]->price = ['text' => 'Стоимость','value' => ($result->rows[0]->elements[0]->distance->value * $_GET['price']).' руб.'];

            print_r(json_encode($result,JSON_OBJECT_AS_ARRAY.JSON_UNESCAPED_SLASHES.JSON_UNESCAPED_UNICODE));

        }

    } catch (Exception $exception) {
        //print_r($exception);
    }
} else {
    header('400 Bad Request', true, 400);
    echo json_encode(['error' => '400 Bad Request']);
}



