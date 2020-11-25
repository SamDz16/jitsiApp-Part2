<?php


namespace backend\controllers;


use yii\web\Controller;

class HomeController extends Controller // Have to create a folder called "home" in the views folder
{
    public function actionHome() // home
    {
        return $this->render('index'); // Have to create a .php file called "index.php" in the home folder
    }
}