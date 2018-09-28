<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 23/05/2018
 * Time: 15:27
 */
session_start();
$title = 'Web Dev Trends';
if (!isset($_SESSION['login']))
{
    require 'inc/header.inc.php';
}
else
{
    require 'inc/headerAuth.inc.php';
}

//todo finaliser le mise en page
?>
<div id="oneArticleCont" class="container">
    <?php $row = $oneArticle->fetch(PDO::FETCH_OBJ); ?>
    <div id="oneArticle" class="card">
      <div class="card-image">
        <figure class="image is-4by3">
          <img src="img/<?= $row->img ?>">
        </figure>
      </div>
      <div class="card-content">
        <div class="content">
            <h2 class="title is-2"><?= $row->title ?></h2>
            <p<?= nl2br($row->content) ?></p> <!-- nl2br() respecte le formatage du texte -->
            <br>
            <time datetime="1-1-2016"><?= $row->date ?></time>
            <br>
            <p><?= $row->firstName.' '.$row->lastName ?></p>
        </div>
      </div>
    </div>
    <p><a class="button is-info" href="index.php" role="button">Revenir à l'accueil</a></p>
</div>


<?php

require 'inc/footer.inc.php';