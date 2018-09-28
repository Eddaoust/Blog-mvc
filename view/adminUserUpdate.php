<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 28/05/2018
 * Time: 12:29
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
                    <li><a href="">Ajouter</a></li>
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

    <div class="column is-half">
        <?php $row = $user->fetch(PDO::FETCH_OBJ) ?>
        <form action="index.php?action=admin&amp;type=user&amp;do=updateOk&amp;id=<?= $row->id ?>" method="post">
            <label class="label" for="firstName">Prénom</label>
            <div class="control">
                <input class="input" type="text" id="firstName" name="firstName" value="<?= $row->firstName ?>">
            </div><br>
            <label class="label" for="lastName">Nom</label>
            <div class="control">
                <input class="input" type="text" id="lastName" name="lastName" value="<?= $row->lastName ?>">
            </div><br>
            <label class="label" for="mail">Mail</label>
            <div class="control">
                <input class="input" type="email" id="mail" name="mail" value="<?= $row->mail ?>">
            </div><br>
            <label class="label" for="login">Login</label>
            <div class="control">
                <input class="input" type="text" id="login" name="login" value="<?= $row->login ?>">
            </div><br>
            <label class="label" for="login">Password</label>
            <div class="control">
                <input class="input" type="password" id="pass" name="pass" value="<?= $row->pass ?>">
            </div><br>
            <div class="control">
                <input class="button is-primary" type="submit" value="Modifier">
            </div>
        </form>
    </div>
</div>







<?php
require 'inc/footer.inc.php';