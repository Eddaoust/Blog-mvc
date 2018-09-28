<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 27/05/2018
 * Time: 21:19
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
        <p>Il y a <span class="has-text-info"><?= $users->rowcount() ?></span> utilisateurs sur le blog.</p><br>
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Mail</th>
                <th>Login</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $users->fetch(PDO::FETCH_OBJ)): ?>
                <tr>
                    <td><?= $row->firstName ?></td>
                    <td><?= $row->lastName ?></td>
                    <td><?= $row->mail ?></td>
                    <td><?= $row->login ?></td>
                    <td class="case"><a class="has-text-info" href="index.php?action=admin&amp;type=user&amp;do=update&amp;id=<?= $row->id ?>"><i class="far fa-edit"></i></a></td>
                    <td class="case"><a class="has-text-danger" href="index.php?action=admin&amp;type=user&amp;do=delete&amp;id=<?= $row->id ?>"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


<?php
require 'inc/footer.inc.php';



