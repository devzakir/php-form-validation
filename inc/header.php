<?php
    $filepath = realpath(dirname(__FILE__));

    include_once $filepath. '/../lib/Session.php';
    Session::init();

    if(isset($_GET['action']) && $_GET['action'] == "logout"){
      Session::destroy();
    }
?>
<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PHP OOP Login Register System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/style.css">
  </head>
  <body>
