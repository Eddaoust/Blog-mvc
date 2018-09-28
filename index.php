<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 03/05/2018
 * Time: 21:54
 */

require 'controller/controller.php';

try
{
    if (isset($_GET['action']) && $_GET['action'] == 'connexion')
    {
        if (checkIfUserExist(strtolower($_POST['login'])) && password_verify($_POST['pass'], getPassword($_POST['login'])))
        {
            /*
             *      Test d'authtentification de l'utilisateur Login et Pass
             */

            session_start();
            $_SESSION['login'] = $_POST['login']; // Initialisation d'une session et attribution d'une valeur
            $_SESSION['name'] = getUserName($_POST['login']); // Récupération du nom complet pour affichage dans la vue
            $_SESSION['id'] = getUserId($_POST['login']);
            header('Location: index.php');
        }
        else
        {
            throw new Exception('Mauvais Login ou Password');
        }
    }
    elseif (isset($_GET['action']) && $_GET['action'] == 'deco')
    {
        /*
         *      Déconnexion de l'utilisateur et destruction de la session
         */
        session_start();
        session_destroy();
        unset($_SESSION);
        header('Location: index.php');
    }
    elseif (isset($_GET['action']) && $_GET['action'] == 'card')
    {

        listCards();

        /*
         *      Affichage des cartes
         */
    }
    elseif (isset($_GET['action']) && $_GET['action'] == 'search' && isset($_GET['val']))
    {
        $_GET['order'] = $_GET['order'] ?? 'ASC';
        $_GET['order'] == 'ASC' ? $_GET['order'] = 'DESC' : $_GET['order'] = 'ASC';
        searchArticles($_GET['val'], $_GET['cat'], $_GET['order']);
        /*
         *      Tri de la liste avec recherche
         */
    }
    elseif (isset($_GET['action']) && $_GET['action'] == 'search')
    {
        searchArticles(trim($_POST['search']), 'date', 'ASC');
        /*
         *      Tri de la recherche par défaut par date et ASC
         */
    }
    elseif (isset($_GET['action']) && $_GET['action'] == 'getId')
    {
        getOne($_GET['id']);
        /*
         *      Affichage d'un article particulier
         */
    }
    elseif  (isset($_GET['action']) && $_GET['action'] == 'tri')
    {
        $_GET['order'] = $_GET['order'] ?? 'ASC';
        $_GET['order'] == 'ASC' ? $_GET['order'] = 'DESC' : $_GET['order'] = 'ASC';
        listPosts($_GET['cat'], $_GET['order']);
        /*
         *      Tri des la liste complete
         */
    }
    elseif (isset($_GET['action']) && $_GET['action'] == 'inscription')
    {
        if (checkIfUserExist(strtolower($_POST['login'])))
        /*
         *      On test si l'utilisateur est déja présent en BDD
         */
        {
            throw new Exception('Login déja utilisé');
        }
        else
        {
            addUser(strtolower($_POST['firstName']), strtolower($_POST['lastName']), strtolower($_POST['mail']), strtolower($_POST['login']), password_hash($_POST['pass'], PASSWORD_DEFAULT));
            /*
             *      Si le login n'est pas présent, on ajoute le User
             */
        }
    }
    elseif (isset($_GET['action']) && ($_GET['action'] == 'admin'))
        /*
         *      On entre dans la section administration
         */
    {
        if (isset($_GET['type']) && $_GET['type'] == 'user')
        /*
         *      On entre dans la section utilisateur
         */
        {
            if(isset($_GET['do']) && $_GET['do'] == 'list')
            /*
             *      Listing des utilisateurs
             */
            {
                getUsers();
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'update')
                /*
                 *      Mise à jour des utilisateurs (Formulaire)
                 */
            {
                getOneUser($_GET['id']);
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'updateOk')
                /*
                 *      Mise à jour des utilisateurs BDD
                 */
            {
                updateUser($_GET['id'], $_POST['firstName'], $_POST['lastName'], $_POST['mail'], $_POST['login'], $_POST['pass']);
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'delete')
                /*
                 *      Suppression utilisateur
                 */
            {
                deleteUser($_GET['id']);
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'add')
                /*
                 *      Formulaire d'ajout d'utilisateur
                 */
            {
                require 'view/adminUserAdd.php';
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'addOk')
                /*
                 *      AJout d'un utilisateur
                 */
            {
                addUser(strtolower($_POST['firstName']), strtolower($_POST['lastName']), strtolower($_POST['mail']), strtolower($_POST['login']), password_hash($_POST['pass'], PASSWORD_DEFAULT));
            }
        }
        elseif (isset($_GET['type']) && $_GET['type'] == 'post')
        {
            /*
             *      On entre dans la section des articles
             */
            if(isset($_GET['do']) && $_GET['do'] == 'list')
            {
                /*
                 *      Listing des articles
                 */
                listPostsAdmin('date', 'ASC');
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'update')
            {
                /*
                 *      Formulaire d'ajout d'articles
                 */
                getOneAdminPost($_GET['id']);
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'updateOk')
            {
                /*
                 *      Ajout d'un article
                 */
                updatePost($_GET['id'], $_POST['title'], $_POST['content'],!empty($_FILES['img']['name']) ? $_FILES['img']['name'] : $_POST['img'], $_POST['cat']);
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'delete')
            {
                /*
                 *      Suppression d'un article
                 */
                deletePost($_GET['id']);
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'add')
            {
                /*
                 *      Formulaire d'ajout d'un article
                 */
                addPostForm();
            }
            elseif (isset($_GET['do']) && $_GET['do'] == 'addOk')
            {
                /*
                 *      Ajout d'un article
                 */
                session_start();
                addPost($_POST['title'], $_POST['content'],$_FILES['img']['name'], $_POST['cat'], $_SESSION['id']);
            }
        }
        else
        {
            throw new Exception('Vous n\'avez pas accès à cette action');
        }
    }
    else
    {
        listPosts('date', 'ASC');
        /*
         *      Affichage de la liste complete par defaut (DATE et ASC)
         */
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

/*
 *      Pour ce projet, j'ai essayer de réaliser une architecture MVC
 *      Index.php est le router
 *      Il se charge de diriger l'utilisateur vers la page qu'il souhaite
 */