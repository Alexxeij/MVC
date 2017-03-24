<?php

/**
 * Created by PhpStorm.
 * Date: 23.03.2017
 * Time: 20:40
 */
class News
{
    /**
     *  integer $id
     */
    public static function getNewsItemById($id){

                  $id=intval($id);
                  if($id) {
                      $db=Db::getConnection();
                      $db->exec('SET NAMES utf-8');
                      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                      $result = $db->query('SELECT*FROM news WHERE id=' . $id);
                      //print_r($result);
                      $result->setFetchMode(PDO::FETCH_ASSOC);
                      $newsItem = $result->fetch();
                      return $newsItem;
                  }

       }

    /**
     *Return an array of news item
     */
    public static function getNewsList(){



        try {
            $dsn = 'mysql:host=localhost;dbname=mvc_site';
            $user = 'root';
            $password = '';
            $db = new PDO($dsn, $user, $password);
            $db->exec('SET NAMES utf-8');
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $newsList=array();


            $result=$db->query('SELECT id,title,date,short_content FROM news');

            //print_r($result);

            $i=0;

            while ($row=$result->fetch()){
                $newsList[$i]['id']=$row['id'];
                $newsList[$i]['title']=$row['title'];
                $newsList[$i]['date']=$row['date'];
                $newsList[$i]['short_content']=$row['short_content'];
                $i++;
            }

            return $newsList;

        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }


}
}