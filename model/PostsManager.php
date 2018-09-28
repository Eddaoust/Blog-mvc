<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 03/05/2018
 * Time: 20:27
 */

class PostsManager
{
    public function getPosts($cat, $order)
    {
        $db = $this->dbConnect();
        $sql = "SELECT posts.id AS postsId, title, DATE_FORMAT(created, '%d/%m/%Y') AS date, category, firstName, lastName
                FROM posts
                LEFT JOIN categories c on posts.idCategory = c.id
                LEFT JOIN users u on posts.idUser = u.id
                ORDER BY {$cat} {$order}";
        $result = $db->prepare($sql);
        $result->execute();

        return $result;
        /*
         *      Fonction de sélection des articles du blog
         *      param $cat & $order : Paramètre de tri des colones de la liste
         */
    }

    public function updatePost($id, $title, $content, $img, $idCat)
    {
        $db = $this->dbConnect();
        $sql = 'UPDATE posts
                SET title = :title,
                content = :content,
                img = :img,
                idCategory = :idCat
                WHERE id = :id';
        $update = $db->prepare($sql);
        $update->bindValue(':title', $title, PDO::PARAM_STR);
        $update->bindValue(':content', $content, PDO::PARAM_STR);
        $update->bindValue(':img', $img, PDO::PARAM_STR);
        $update->bindValue(':idCat', $idCat, PDO::PARAM_INT);
        $update->bindValue(':id', $id, PDO::PARAM_INT);
        $update->execute();
    }

    public function addPost($title, $content, $img, $idCat, $idUser)
    {
        $db = $this->dbConnect();
        $sql = 'INSERT INTO posts (title, content, img, created, idCategory, idUser)
                VALUES (:title, :content, :img, NOW(), :idCat, :idUser)';
        $insert = $db->prepare($sql);
        $insert->bindValue(':title', $title, PDO::PARAM_STR);
        $insert->bindValue(':content', $content, PDO::PARAM_STR);
        $insert->bindValue(':img', $img, PDO::PARAM_STR);
        $insert->bindValue(':idCat', $idCat, PDO::PARAM_INT);
        $insert->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $insert->execute();
    }

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $sql = 'DELETE FROM posts
                WHERE id = :id';
        $delete = $db->prepare($sql);
        $delete->bindValue(':id', $id, PDO::PARAM_INT);
        $delete->execute();
    }

    public function getCards()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT title, content, img, DATE_FORMAT(created, \'%d/%m/%Y\') AS date
                FROM posts
                ORDER BY date DESC LIMIT 0, 5';
        $result = $db->prepare($sql);
        $result->execute();

        return $result;
        /*
         *      Fonction de sélection des articles pour les cards
         */
    }

    public function getSearch($search, $cat, $order)
    {
        $db = $this->dbConnect();
        $sql = "SELECT posts.id AS postsId, title, DATE_FORMAT(created, '%d/%m/%Y') AS date, category, firstName, lastName
                FROM posts
                LEFT JOIN categories c on posts.idCategory = c.id
                LEFT JOIN users u on posts.idUser = u.id
                WHERE title like :search
                ORDER BY {$cat} {$order}";
        $result = $db->prepare($sql);
        $result->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $result->execute();

        return $result;
        /*
         *      Fonction qui sélectionne les articles recherchés par l'utilisateur
         */
    }

    public function getOne($id)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT posts.id AS postsId, idCategory, title, content, img, DATE_FORMAT(created, \'%d/%m/%Y\') AS date, category, firstName, lastName
                FROM posts
                LEFT JOIN categories c on posts.idCategory = c.id
                LEFT JOIN users u on posts.idUser = u.id
                WHERE posts.id like :id';
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result;
        /*
         *      Fonction qui affiche l'article passé en param via son Id
         */
    }

    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=blog_tp;charste=utf8', 'root', 'root');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
        /*
         *      Par défaut :
         *      Mac OSX password = 'root'
         *      Windows password = ''
         */
    }
}