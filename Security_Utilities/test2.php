<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
///var/www/html/KuaminikaWorkspace/KMailList/VendorUtilities/JWT/src/JWT.php
require_once dirname(__FILE__)."/../VendorUtilities/JWT/src/JWT.php";
require_once dirname(__FILE__)."/../VendorUtilities/JWT/src/SignatureInvalidException.php";

use \Firebase\JWT\JWT;

$key = "example_key";
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = JWT::encode($payload, $key);
echo $jwt;
try {
    //code...
$decoded = JWT::decode($jwt, $key."1", array('HS256'));
} catch (\Throwable $th) {
    //throw $th;

    echo $th->getMessage();
    exit();
}

print_r($decoded);

/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

$decoded_array = (array) $decoded;

/**
 * You can add a leeway to account for when there is a clock skew times between
 * the signing and verifying servers. It is recommended that this leeway should
 */



