<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 28/05/2018
 * Time: 14:21
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

    <div class="column is-half">
        <form id="add" action="index.php?action=admin&amp;type=user&amp;do=addOk" method="post">
            <div class="control"><br>
                <label for="firstName" class="label">Prénom</label>
                <input type="text" class="input" id="firstName" name="firstName" placeholder="Prénom" required>
            </div>
            <div class="control"><br>
                <label for="lastName" class="label">Nom</label>
                <input type="text" class="input" id="lastName" name="lastName" placeholder="Nom" required>
            </div>
            <div class="control"><br>
                <label for="mail" class="label">Mail</label>
                <input type="email" class="input" id="mail" name="mail" placeholder="Email" required>
            </div>
            <div class="control"><br>
                <label for="login" class="label">Login</label>
                <input type="text" class="input" id="login" name="login" placeholder="Login" required>
            </div>
            <div class="control"><br>
                <label for="pass" class="label">Password</label>
                <input type="password" class="input" id="pass" name="pass" placeholder="Password" required>
            </div>
            <div class="control"><br>
                <input type="submit" class="button is-primary" id="submit" name="submit" value="Ajouter">
            </div>
        </form>
    </div>
</div>

<?php
require 'inc/footer.inc.php';