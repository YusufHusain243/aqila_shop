<?php
$host       = 'localhost';
$username   = 'root';
$password   = '';
$dbname     = 'aqila_shop';
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function show_data($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function login($username, $password)
{
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM pengguna WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

?>