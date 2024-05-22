<?php

$currentUrl = $_SERVER['REQUEST_URI'];

$title = 'APIK';

$pageTitles = array(
    "/" => "Home Page",
    "/dashboard" => "Dashboard",
    "/dokter" => "Dokter",
    "/pasien" => "Pasien",
    "/poliklinik" => "Poliklinik",
    "/obat" => "Obat",
    "/pendaftaran" => "Pendaftaran",
    "/resep" => "Resep",
    "/pembayaran" => "Pembayaran",
    "/antrian" => "Antrian",
    "/halaman-tidak-ditemukan" => "404 - Not Found",
    "/login" => "Login"
);


if (array_key_exists($currentUrl, $pageTitles)) {
    $title = $pageTitles[$currentUrl] . " | APIK";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link rel="shortcut icon" href="public/assets/compiled/png/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="public/assets/extensions/simple-datatables/style.css">

    <link rel="stylesheet" href="public/assets/extensions/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="public/assets/compiled/css/table-datatable.css">
    <link rel="stylesheet" href="public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="public/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="public/assets/compiled/css/iconly.css">

    <link rel="stylesheet" href="public/assets/compiled/css/error.css">

    <link rel="stylesheet" href="public/assets/compiled/css/auth.css">
    
    <link rel="stylesheet" href="public/build/css/intlTelInput.css">
    
    <style>
    html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }
    #main {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .content {
        flex: 1;
    }
    footer {
        padding: 1rem 0;
        text-align: center;
        margin-top: auto;
    }
</style>

</head>

<body>
    <script src="public/assets/static/js/initTheme.js"></script>

