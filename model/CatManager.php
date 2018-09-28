<?php
/**
 * Created by PhpStorm.
 * User: edmonddaoust
 * Date: 31/05/2018
 * Time: 09:44
 */

class CatManager
{

    public function getCategory()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT * 
                FROM categories
                ORDER BY id ASC';
        $result = $db->prepare($sql);
        $result->execute();

        return $result;
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