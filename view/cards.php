<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 03/05/2018
 * Time: 22:49
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
?>

    <section class="hero is-medium is-light">
        <div class="hero-body">
            <div class="container">
                <h1 class="title is-3 has-text-grey">Bienvenu sur ce blog consacré au développement web</h1>
                <a class="button is-info" href="index.php" role="button">Revenir à l'accueil</a>
            </div>
        </div>
    </section>

    <section class="section has-background-info section-padding">
        <div class="columns">
        <?php while ($row = $cards->fetch(PDO::FETCH_OBJ)):?>
            <div id="cardsView" class="card column">
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img src="img/<?= $row->img ?>" alt="Placeholder image">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="img/<?= $row->img ?>" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-6"><?= $row->title ?></p>
                        </div>
                    </div>

                    <div class="content">
                        <?= substr($row->content, 0, 200) ?>...
                    </div>
                    <a href="#" class="button is-danger">Lire plus</a>
                </div>
            </div>
        <?php endwhile;?>
        </div>
    </section>

<?php
//TODO revoir l'affichage des cards qui est merdique
require 'inc/footer.inc.php';