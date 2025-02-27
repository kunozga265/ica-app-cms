<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google;

class NotificationController extends Controller
{
    public function pushNotification($to, $subject, $message)
    {
        // create the Google client
        $client = new Google\Client();
        $client->setAuthConfig($this->credentials);
        $client->addScope(Google\Service\FirebaseCloudMessaging::FIREBASE_MESSAGING);
        $httpClient = $client->authorize();
        $token1 = $client->getRefreshToken();
        $token = $client->getAccessToken();
//        $token = $client->();

        $res = $httpClient->post('https://fcm.googleapis.com/v1/projects/ica-app-4de51/messages:send', [
//            'headers' => [
//                'Authorization' => 'Bearer AAAAQdj1ZOU:APA91bHbQ6JbhcEoHTyQthEp1j8QjlDUM7ftsFmcMRUvgKuZJBy5-IQQ_6eZZAfJ5fUM1qP60dATN-DiOzM3LcUnjcjR7-vGzE02iC7jCEuJU3GC_qrLXcxyY6P7zy57joaqbytyWj59',
//                'Content-Type' => 'application/json',
//            ],
            'json' => [
                "message" => [
                    "topic" => $to,
                    "notification" => [
                        "title" => $subject,
                        "body" => $message
                    ],
                ]
            ]
        ]);

//        dd($token1, $token, $res, $httpClient);

//        $response = $httpClient->get('https://www.googleapis.com/plus/v1/people/me');

    }

    public $credentials = [

  "type"=> "service_account",
  "project_id"=> "ica-app-4de51",
  "private_key_id"=> "6acb6a1990f5e39980d65b57d8b8771023c78b6a",
  "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCjNVmcxkO5+Au/\nXxTq1in4jPhf4MQ8vg9ErHwXns46cnDBeA6Iul2/QuNeuJ6ZugcZd5eumL3i3Pyr\nSUMaVI0MbfK6RlV+0Hgb4g+NiKtjwR6e/1+p9NRLVf+x3cEKFmmp9ks62omaJWcr\nXRR6S4g2aY7mz/UCHwgEY7EDewyncF0u7op14LpA52raB9IOfqm8escsrKDfHoKx\n5ovzzfc3MKdxodEQoMTV0j9AmrTzfnCfwNtLKVSyUbhiZFGVPfE0GjitZGQ3fpND\nrMJ+1WbKa4iHFoOcjD/ZxueYZjFfVkuOTZlRileD/SzbhUtEOVhCw+rXnfpvtBVg\nE1TTDXRfAgMBAAECggEAQ2Xss8lMfqfocgcZ5EC85F+S0kVHxK3YMEvqkvaJw6ku\n1zZ1ChGsVSeSLbOgC2u/Ms0oXnnFMMKBtVpz05PHC7L74eDZvZzpfNpGAfTGklNW\nCeL75nusj8/b39/rr/bBe+ax+oP0/ysjB81Qf5Bhl9bPpJGMZGvcK7Pfjchq2Vns\nezmRVK6i96NSYF1PnvQGe36s4cSReNXuDNcj0+Lz6sqqR+NzvC37LLLzo//kS+3n\nBeQLd7PP7vIekyQ4Hf6FOnNfrSLFRaH+tqaQNFBLc7q5GCF0kzLIjAQYVmMTrf8q\nVopB7XcCRIVqwxYC0PLhgwwsIH9O8oPBwSYV7TFvQQKBgQDZfVE6p3gCRvIcimDB\n1pMlJ7XvVHq2lVcIBXBvX+WpUaxdyi72X+LTDuqub3cv3Mw+5rc2QzV0UDSdhTax\nuq1rS7s8NS2Q618JelTmKEVdLZYBHhrxyFCbUr3ESxS2PQxO6656iNU8LGANtVoc\nzu6Ed0JWnf09E0+RONCPdENlywKBgQDAG3+uQxipFdJm3q0xZfhUr1taJfj6lRQ4\nvJsvUN+HM7MoG2Z8QS87dOSv2kL/MBnpzE4diri0PXgC03c5EdF+yQl0yLTfehA2\nFi0xNydifV8hreVtw9FwUyf4mWmZ2Mi8LxoVZzuA796pK8LZViMTdIE1XQKW5uxi\nNKgHjXw5PQKBgQDG4QKbiTKDmo6hLKTH/Eh4DHUhEnZYaf241wh2wBGKIKZm6ZDC\nOPJ5H8XYlxM9UEHxLxbQZusFnqZOeNeH9HXKjOj9aH9vatxwFU53XNH5H8tw4C+x\ncwTK1AG18xZQg0izDm9xm5iqOsXnIzPw7gVMWqXuAPDmnbb/zB1jYOSUuwKBgCcz\n9WRccOXgfCVd/7367yho+J127k5EqfHCG3EWcecnV8IxhUKKEtdxTVHNmqp06HTb\nqn1A19yARsNc4BGXX0ceQ32/j5mjUTeYYvSOKs1ghE9dK1qxAUaI0blbpT8uDBjL\nC+mePXhcevXO5l5vw4yu08dOCb89tLN9x2RzLQyJAoGAfVJFyp9GOcG1l8Z4mk9o\n6IEr2OeI2QSCLeH2WVBi8C2DuJ3uIe8AyLBJ/icg4aE6us7ag0s8lE0fqOVwBddk\nOOKye+KdubVQQNeSJreENcrSkFnyw3s/lfbHInVYEKoiPtNP1FJEnMeAsUB0DWPi\n3F7ILa5Jaaf4qNOvepEwHvU=\n-----END PRIVATE KEY-----\n",
  "client_email"=> "firebase-adminsdk-6sb8g@ica-app-4de51.iam.gserviceaccount.com",
  "client_id"=> "107986912801882421625",
  "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
  "token_uri"=> "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-6sb8g%40ica-app-4de51.iam.gserviceaccount.com",
  "universe_domain"=> "googleapis.com"
];

//    public $credentials = [
//        "type" => "service_account",
//        "project_id" => "ica-flutter-app",
//        "private_key_id" => "93f4f38b639de71697f5db5524d11eeeaccf35a8",
//        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDBN9cydyR96x5l\nFBli+PpGIRxGW1M5qcaZlTBThCzGNWiNHcWiZlJ7GXvTMq+uf0QYEhBJq2EwHvi9\ntsF3uMhslxOI2GA4iHtEHbEstB3Fyz0l9C05sBS40GK7hp2IEP6oM6KykSY2TUVK\n00rf50u14I2CBAgpxQjMm5U8ZyacSc9eIcroCVMbeyoO9PkNfYYSO6nfcMEBnA4b\nKud3+0A/Ar2xJWEBQ+IOvgA9bhLSkZp93PgHmacPDvAZA+DAfptrc49gVk8vEPlB\n+RpWvISvtU4AJ4JeXBLRqhtPEG/gHx8XH2DqSIEE+r3HAYUnm4BYw+eoh8sDhnF9\nFUttncMRAgMBAAECggEACO6xsGfRJFAZDt+zv79WZKUVt0v0CEOoxoNe4VGIN16T\nN4jjkNstn3rBXnVmqUjBZ2J4Zct6Of0Ij06yWXxNqbV/RfGI2zw2BKNhxDkMck8v\nw8Aq0hKplpStp9E0max9dV2zvREYROTkGe40NS8ucRlROWxBy1qMSlc7+jejkZCE\nOwidY7tIRcUHeeAn3slF5lhoHcs3G/BeYu80QLGhVHtwerdBu3qDDk22l8HFcggn\ncM/PVMQkLkLFSWtLGIHshcj5w1zZpCA0I0Y8yTTr44cjJLwLZfs+/XLM3v697wCg\nE7cX2PYVorkiEGUHj82jRXr160cqmWRJ7fx53zOhAQKBgQD92GUtdQXh7qqfz9Kq\nGpNKO2zEsgshoznaj3/n7IHzM1sFeS1fHDm2+sjeIiPL7yhP2OESVX+L6thahick\ncZRvufp3ERa6YgskTwarkcKn688RH34q7/gFT7FsDtuJ8ejjH6SL/2KYOV0zjvm+\n+FK6mDznRz4YiqQTSroMzaGQUQKBgQDC27PrInmLk1MFvqXImyeE+yLt3QjwczwW\naUqzK2mVMfN5FmINtEPlmJe2D4O3eVcK+uUHd2FG2uAT++Ie885ORsbOOIJwHFsg\n+cJpvyZBswTqkZmioUQYQ7HkhXZTJC2muBKfV8azhCF0ix+rPqqs27GziEviH2m+\npWeoBJkWwQKBgQCavSTAFwvk8+YS0U7r3pNWtu7Q4G+kq6mCr+Mab7OvmuirZ3je\n94e/IRT9Q/ZqRHlgYyagVHoRwrDsTcbiklIX4Vjq6AHg0A9WrM22HH56emaZW4c/\niVS5eCEBa/UsG8kJWqqlpKJnhOBpo4hef2V+1XqayXTy5OCr2eucDmWkYQKBgEvz\nqSCI0omWBjFiC2qzF2ddIFNI6bgXop81sVk/Hat6yeUz1Up0Llbq8I+VYoj8cfIk\ns2sCnFcq71a6wnvAGnUmX014d1dNpjOnRqFDUZ0gM1VfJVxfsZQnpsplPybPHkAy\n1YdohlnoscWkiNaN2acBBzXsdW+RQP1/qXSzPhzBAoGBAOkLYu7U2e03UQAD6n7e\nbNe5tnfw17dHy2JpqkxhrRCVOtSTstAGBkkVFoPenAJ62IoQC85NJDQ9VW3tLcev\nLi7i/HnY0l1XpL0KmbWbB4FedwfpBFRGcfYRpP/jFCNzG2OICrDfrQbMYAFm+kJ6\n0BUSIIP4hUn3lAIK9wpM0kD9\n-----END PRIVATE KEY-----\n",
//        "client_email" => "firebase-adminsdk-s3v3y@ica-flutter-app.iam.gserviceaccount.com",
//        "client_id" => "111129225531227798485",
//        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
//        "token_uri" => "https://oauth2.googleapis.com/token",
//        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
//        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-s3v3y%40ica-flutter-app.iam.gserviceaccount.com",
//        "universe_domain" => "googleapis.com"
//    ];

}
