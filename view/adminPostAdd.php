<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 31/05/2018
 * Time: 11:29
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
        <form action="index.php?action=admin&amp;type=post&amp;do=addOk" method="post" enctype="multipart/form-data">
            <label class="label" for="title">Titre</label>
            <div class="control">
                <input class="input" type="text" id="title" name="title" placeholder="Titre" required>
            </div><br>
            <label class="label" for="content">Contenu</label>
            <div class="control">
                <textarea class="textarea" id="content" name="content" placeholder="Contenu" required></textarea>
            </div><br>
            <label class="label" for="category">Categorie</label>
            <div class="control">
                <div class="select">
                    <select id="cat" name="cat" required>
                        <?php while ($cat = $categories->fetch(PDO::FETCH_OBJ)) :?>
                            <option value="<?= $cat->id ?>"><?= $cat->category ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="control"><br>
                <div class="file">
                    <label class="file-label label">Image<br>
                        <input class="file-input" type="file" name="img">
                        <span class="file-cta">
                        <span class="file-icon">
                        <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">Choose a file…</span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="control"><br>
                <input class="button is-primary" type="submit" value="Ajouter">
            </div>
        </form>
    </div>
</div>

<?php
require 'inc/footer.inc.php';