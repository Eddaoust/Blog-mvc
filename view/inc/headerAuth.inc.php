<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 25/05/2018
 * Time: 09:40
 */

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="view/inc/css/style.css">
    <title><?= $title ?></title>
</head>
<body>

<header>
    <nav id="nav" class="navbar is-info">
        <div class="navbar-brand">
            <a class="title is-2 has-text-white" href="https://bulma.io"><i class="fas fa-code has-text-danger"></i> Web Dev Trends | Blog</a>
        </div>
        <div class="navbar-menu">
            <div class="navbar-end">
                <div class="field is-grouped">
                    <div class="control">
                        <a class="button is-primary" title="Disabled button" disabled>Utilisateur : <?= $_SESSION['name'] ?></a>
                    </div>
                    <div class="control">
                        <a href="?action=admin&amp;type=user&amp;do=list" class="button is-primary">Admin</a>
                    </div>
                    <div class="control">
                        <a href="index.php?action=deco" class="button is-danger">Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
