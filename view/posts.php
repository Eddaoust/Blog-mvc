<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 03/05/2018
 * Time: 21:07
 */
session_start();
$title = 'Web Dev Trends';
/*
 *      Test de présence d'une session pour afficher le header correspondant
 */
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

                <!-- Formulaire de Recherche d'un article-->
                <form action="index.php?action=search&amp;cat=<?= $cat ?>&amp;order=<?= $order ?>"" method="post">
                    <div class="field has-addons">
                        <div class="control has-icons-left">
                            <input class="input" type="text" id="search" name="search" placeholder="Chercher un article">
                            <span class="icon is-small is-left"><i class="fas fa-search"></i></span>
                        </div>
                        <div class="control">
                            <input class="button is-info" type="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section section-padding">
        <div class="container">
            <p id="countP">Il y a <span class="has-text-info"><?= $posts->rowcount() ?></span> article(s) sur le blog.</p>
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                <tr>
                    <!-- Lien de tri des colones du listing -->
                    <th><a href="index.php?action=tri&amp;cat=title&amp;order=<?= $order ?>">Titre</a></th>
                    <th><a href="index.php?action=tri&amp;cat=firstName&amp;order=<?= $order ?>">Prénom</a></th>
                    <th><a href="index.php?action=tri&amp;cat=lastName&amp;order=<?= $order ?>">Nom</a></th>
                    <th><a href="index.php?action=tri&amp;cat=date&amp;order=<?= $order ?>">Date</a></th>
                    <th><a href="index.php?action=tri&amp;cat=category&amp;order=<?= $order ?>">Catégorie</a></th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $posts->fetch(PDO::FETCH_OBJ)):?>
                    <tr>
                        <td><a href="index.php?action=getId&amp;id=<?= $row->postsId?>"><?= $row->title ?></a></td>
                        <td><?= $row->firstName ?></td>
                        <td><?= $row->lastName ?></td>
                        <td><?= $row->date ?></td>
                        <td><?= $row->category ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
            <a class="button is-info" href="index.php?action=card" role="button">Afficher les Cards</a>
        </div>
    </section>

<?php
require 'inc/footer.inc.php';
