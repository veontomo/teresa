<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * Extension of Controller to include language support
 * @author A.Shcherbakov
 * @since  0.0.1
 */
class ControllerPolyglot extends Controller
{
    private $lang = 'it';

    public function setLang($lang){
        $this->lang = $lang;
    }

    public function getLang(){
        return $this->lang;
    }
}