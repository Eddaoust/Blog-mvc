<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 03/05/2018
 * Time: 21:09
 */

require 'model/PostsManager.php';
require 'model/UsersManager.php';
require 'model/CatManager.php';

//////////////////////////// USERS ////////////////////////////

function addUser($firstName, $lastName, $mail, $login, $pass)
{
    $userManager = new UsersManager();
    $addUser = $userManager->addUser($firstName, $lastName, $mail, $login, $pass);

    header('Location: index.php');
    /*
     *      Ajout d'un utilisateur
     */
}

function updateUser($id, $firstName, $lastName, $mail, $login, $pass)
{
    $userManager = new UsersManager();
    $update = $userManager->updateUser($id, $firstName, $lastName, $mail, $login, $pass);

    header('Location: index.php?action=admin&type=user&do=list'); // Pas besoin de mettre &amp; dans le lien
    /*
     *      Mise a jour d'un utilisateur
     */
}

function deleteUser($id)
{
    $userManager = new UsersManager();
    $delete = $userManager->deleteUser($id);

    header('Location: index.php?action=admin&type=user&do=list');
    /*
     *      Suppression d'un utilisateur
     */
}

function checkIfUserExist($login)
{
    $userManager = new UsersManager();
    $oneUser = $userManager->checkIfUserExist($login);

    if (!$oneUser->rowCount())
    {
        return false;
    }
    else
    {
        return true;
    }
    /*
     *      Vérification de la disponibilité du login
     */
}

function getPassword($login)
{
    $userManager = new UsersManager();
    $pass = $userManager->getPassword($login);
    $passHash = $pass->fetch(PDO::FETCH_OBJ);
    return $passHash->pass;
    /*
     *      Récupération du PassHash pour authentification
     */
}

function getUserName($login)
{
    $userManager = new UsersManager();
    $rep = $userManager->getUserName($login);
    $name = $rep->fetch(PDO::FETCH_OBJ);
    return $name->firstName.' '.$name->lastName;
    /*
     *      Récupération du prénom et nom de l'utilisateur passé en paramètre
     *      Retourne la concaténation du prénom et du nom pour affichage dans la vue
     */
}

function getUsers()
{
    $userManager = new UsersManager();
    $users = $userManager->getUsers();

    require 'view/admin.php';
    /*
     *      Récupération de tous les utilisateurs
     */
}

function getOneUser($id)
{
    $userManager = new UsersManager();
    $user = $userManager->getOneUser($id);

    require 'view/adminUserUpdate.php';
    /*
     *      Récupération d'un utilisateur afin de pré-remplir le formulaire d'update
     */
}

function getUserId($login)
{
    $userManager = new UsersManager();
    $userId = $userManager->getUserId($login);
    $id = $userId->fetch(PDO::FETCH_OBJ);
    return $id->id;
    /*
     *      Récupération de l'id par le login afin d'ajouter un article en fonction de l'utilisateur connecté
     */
}





//////////////////////////// POSTS ////////////////////////////


function listPosts($cat, $order)
{
    $postsManager = new PostsManager();
    $posts = $postsManager->getPosts($cat, $order);

    require 'view/posts.php';
    /*
     *      Listing de tous les articles
     */
}

function listPostsAdmin($cat, $order)
{
    $postsManager = new PostsManager();
    $posts = $postsManager->getPosts($cat, $order);

    require 'view/adminPosts.php';
    /*
     *      Listing des articles dans l'administration
     */
}

function listCards()
{

    $postsManager = new PostsManager();
    $cards = $postsManager->getCards();

    require 'view/cards.php';
    /*
     *      Listing des Cards
     */
}
function searchArticles($search, $cat, $order)
{
    $postManager = new PostsManager();
    $articleSearch = $postManager->getSearch($search, $cat, $order);

    require 'view/search.php';
    /*
     *      Recherche dans les articles
     */
}

function getOne($id)
{
    $postManager = new PostsManager();
    $oneArticle = $postManager->getOne($id);

    require 'view/article.php';
    /*
     *      Sélection d'un seul article
     */
}

function getOneAdminPost($id)
{
    $postManager = new PostsManager();
    $oneArticle = $postManager->getOne($id);
    $catManager = new CatManager();
    $categories = $catManager->getCategory();

    require 'view/adminPostsUpdate.php';
    /*
     *      Sélection d'un seul article pour formulaire d'update dans l'admin
     */
}

function addPostForm()
{
    $catManager = new CatManager();
    $categories = $catManager->getCategory();

    require 'view/adminPostAdd.php';
    /*
     *      Direction vers le formulaire d'ajout d'article (Category pour liste déroulante)
     */
}

function addPost($title, $content, $img, $idCat, $idUser)
{
    $postManager = new PostsManager();
    $addPost = $postManager->addPost($title, $content, $img, $idCat, $idUser);
    move_uploaded_file($_FILES['img']['tmp_name'], 'img/'.$_FILES['img']['name']); // tmp_name > fichier temporaire, nom générique
    header('Location: index.php?action=admin&type=post&do=list');
    /*
     *      Ajout d'un article
     */
}



function updatePost($id, $title, $content, $img, $idCat)
{
    $postManager = new PostsManager();
    $update = $postManager->updatePost($id, $title, $content, $img, $idCat);

    if(!empty($_FILES['img'])) {
        move_uploaded_file($_FILES['img']['tmp_name'], 'img/'.$_FILES['img']['name']);
    }

    header('Location: index.php?action=admin&type=post&do=list');
    /*
     *      Modification d'un article
     */
}

function deletePost($id)
{
    $postManager = new PostsManager();
    $delete = $postManager->deletePost($id);

    header('Location: index.php?action=admin&type=post&do=list');
    /*
     *      Suppression d'un article
     */
}

