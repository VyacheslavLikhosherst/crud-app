<?php
session_start();

if($_SESSION['user']) {
    header('Location: index.php');
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login.css">
    <title>Авторизация</title>
</head>
<body>

<!-- Форма авторизации -->
<form class="login-form" action="classes/loginHandler.php" method="POST">
    <h1>Авторизация</h1>
    <div class="mb-3">
        <label for="inputLogin" class="form-label">Login:</label>
        <input type="text" required class="form-control" id="inputLogin" name="login">
        <div id="emailHelp" class="form-text">Подсказка</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password:</label>
        <input type="password" required class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
    <p><strong>Вы не зарегистрированы? - <a href="register.php">Регистрация</a>.</strong></p>
    <?php

    require_once 'vendor/autoload.php';

    // init configuration
    $clientID = '905762750898-0mcmvggdpg7flpu2fl8jf4iqp9n1d2dq.apps.googleusercontent.com';
    $clientSecret = 'N_6my7ub_rDg3QJhOehgc4JM';
    $redirectUri = 'http://localhost/login.php';

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // get profile in   fo
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;
        $nameAc = $name;

        $_SESSION['user'] = true;
        $_SESSION['email'] = $email;

        // now you can use this profile info to create account in your website and make user logged in.
    } else {
        echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
    }

    ?>
    <?php
    if($_SESSION['message']) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">$_SESSION[message]</div>";
        unset($_SESSION['message']);
    }
    ?>
</form>
</body>
</html>
