<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 28/05/2018
 * Time: 15:53
 */
session_start();
if (!isset($_SESSION['login']))
{
    /*
     *      Protection de la page admin avec les sessions
     */
    header('Location: index.php');

}
$title = 'Web Dev Trends';
require 'inc/headerAuth.inc.php';
?>
<div class="columns adminCont">
    <div class="column is-one-quarter">
        <ul class="menu-list">
            <li>Utilisateurs</li>
            <li>
                <ul>
                    <li><a href="index.php?action=admin&amp;type=user&amp;do=add">Ajouter</a></li>
                    <li><a href="index.php?action=admin&amp;type=user&amp;do=list">Gérer</a></li>
                </ul>
            </li>
            <li>Articles</li>
            <li>
                <ul>
                    <li><a href="index.php?action=admin&amp;type=post&amp;do=add">Ajouter</a></li>
                    <li><a href="index.php?action=admin&amp;type=post&amp;do=list">Gérer</a></li>
                </ul>
            </li>
            <li><a href="index.php">Retour à l'accueil</a></li>
        </ul>
    </div>
    <div class="column">
        <p>Il y a <span class="has-text-info"><?= $posts->rowcount() ?></span> article(s) sur le blog.</p><br>
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr>
                <!-- Lien de tri des colones du listing -->
                <th>Titre</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Catégorie</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                <th>Affichage</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $posts->fetch(PDO::FETCH_OBJ)):?>
                <tr>
                    <td><?= $row->title ?></td>
                    <td><?= $row->firstName ?></td>
                    <td><?= $row->lastName ?></td>
                    <td><?= $row->date ?></td>
                    <td><?= $row->category ?></td>
                    <td class="case"><a class="has-text-info" href="index.php?action=admin&amp;type=post&amp;do=update&amp;id=<?= $row->postsId ?>"><i class="far fa-edit"></i></a></td>
                    <td class="case"><a class="has-text-danger" href="index.php?action=admin&amp;type=post&amp;do=delete&amp;id=<?= $row->postsId ?>"><i class="far fa-trash-alt"></i></a></td>
                    <td class="case"><a class="has-text-link" href="index.php?action=admin&amp;type=post&amp;do=&amp;id=<?= $row->postsId ?>"><i class="fas fa-eye-slash"></i></a></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>


<?php
require 'inc/footer.inc.php';