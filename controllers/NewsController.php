<?php

/**
 * Created by PhpStorm.
 * Date: 23.03.2017
 * Time: 18:29
 */
include_once ROOT.'/models/News.php';

class NewsController
{
  public function actionIndex(){
      $newsList =array();
      $newsList= News::getNewsList();

      require_once (ROOT.'/views/news/index.php');

      return true;
  }

    /**
     * @param $id
     * @return bool
     */
    public function actionView($id){

      if($id){
         $newsItem =News::getNewsItemById($id);
          echo "<pre>";
          print_r($newsItem);
          echo "</pre>";
      }
      return true;
  }
}