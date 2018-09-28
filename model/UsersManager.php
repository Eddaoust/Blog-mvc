<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 24/05/2018
 * Time: 13:42
 */

class UsersManager
{
    public function addUser($firstName, $lastName, $mail, $login, $pass)
    {
        $db = $this->dbConnect();
        $sql = 'INSERT INTO users (firstName, lastName, mail, login, pass)
                VALUES (:firstName, :lastName, :mail, :login, :pass)';
        $insert = $db->prepare($sql);
        $insert->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $insert->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $insert->bindValue(':mail', $mail, PDO::PARAM_STR);
        $insert->bindValue(':login', $login, PDO::PARAM_STR);
        $insert->bindValue(':pass', $pass, PDO::PARAM_STR);
        $insert->execute();
        /*
         *      Ajout d'un utilisateur
         */
    }

    public function updateUser($id, $firstName, $lastName, $mail, $login, $pass)
    {
        $db = $this->dbConnect();
        $sql = 'UPDATE users
                SET firstName = :firstName,
                lastName = :lastName,
                mail = :mail,
                login = :login,
                pass = :pass
                WHERE id = '.$id;
        $update = $db->prepare($sql);
        $update->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $update->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $update->bindValue(':mail', $mail, PDO::PARAM_STR);
        $update->bindValue(':login', $login, PDO::PARAM_STR);
        $update->bindValue(':pass', password_hash($pass, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $update->execute();
        /*
         *      Mise a jour d'un utilisateur
         */
    }

    public function deleteUser($id)
    {
        $db = $this->dbConnect();
        $sql = 'DELETE FROM users
                WHERE id = '.$id;
        $del = $db->prepare($sql);
        $del->execute();
        /*
         *      Suppression d'un utilisateur
         */
    }

    public function getUsers()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT *
                FROM users
                ORDER BY id ASC';
        $result = $db->prepare($sql);
        $result->execute();

        return $result;
        /*
         *      Liste de tous les utilisateurs
         */
    }

    public function getOneUser($id)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT *
                FROM users
                WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result;
    }

    public function checkIfUserExist($login)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT login
                FROM users
                WHERE login = :login';
        $result = $db->prepare($sql);
        $result->bindValue(':login', $login, PDO::PARAM_STR);
        $result->execute();

        return $result;
        /*
         *      Test de l'existence du login
         */
    }

    public function getUserName($login)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT firstName, lastName
                FROM users
                WHERE login = :login';
        $result = $db->prepare($sql);
        $result->bindValue(':login', $login, PDO::PARAM_STR);
        $result->execute();

        return $result;
        /*
         *      Récupération du prénom et du nom de l'utilisateur
         */
    }

    public function getUserId($login)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id
                FROM users
                WHERE login = :login';
        $result = $db->prepare($sql);
        $result->bindValue(':login', $login, PDO::PARAM_STR);
        $result->execute();

        return $result;

    }

    public function getPassword($login)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT pass
                FROM users
                WHERE login = :login';
        $result = $db->prepare($sql);
        $result->bindValue(':login', $login, PDO::PARAM_STR);
        $result->execute();

        return $result;
        /*
         *      Récupération du Password lié au login pour la connexion
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