<?php
session_set_cookie_params(0, "/harrs");
session_name("harrs");
session_start();

if (!isset($_SESSION['username'])) {
  header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="H.A. Room Rental System (HARRS) is a system for room rental management">
    <meta name="author" content="Vicento14">

    <?php if ($_SERVER['REQUEST_URI'] == "/harrs/admin/dashboard.php") {?>
    <title>HARRS - Dashboard</title>
    <?php } else if ($_SERVER['REQUEST_URI'] == "/harrs/admin/accounts.php") {?>
    <title>HARRS - Accounts</title>
    <?php } else if ($_SERVER['REQUEST_URI'] == "/harrs/admin/rooms.php") {?>
    <title>HARRS - Rooms</title>
    <?php } else if ($_SERVER['REQUEST_URI'] == "/harrs/admin/tables.php") {?>
    <title>HARRS - Tables</title>
    <?php } ?>

    <!-- Custom fonts for this template-->
    <link rel="preload" href="../css/font.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="../vendor/fontawesome-free/css/all.min.css" as="style" onload="this.rel='stylesheet'">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">

    <!-- Custom styles for this template-->
    <link rel="preload" href="../css/sb-admin-2.min.css" as="style" onload="this.rel='stylesheet'">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <?php if ($_SERVER['REQUEST_URI'] == "/harrs/admin/tables.php") {?>
    <!-- Custom styles for this page -->
    <link rel="preload" href="../vendor/datatables/dataTables.bootstrap4.min.css" as="style" onload="this.rel='stylesheet'">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <?php } ?>

    <noscript>
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    </noscript>

    <link rel="icon" type="image/x-icon" href="../img/HA_RRS_Logo.ico">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">