<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'icecream_db';

$conn = new mysqli($host, $user, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!function_exists('unique_id')) {
    function unique_id()
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $chars[mt_rand(0, $charLength - 1)];
        }
        return $randomString;
    }
}
?>