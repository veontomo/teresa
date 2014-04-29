<?php
namespace app\components;
use Yii;
use app\models\Lang;
use yii\web\Session;

/**
* This class manages language support. It requires Lang class.
*
* @property Lang $_lang
* @author A.Shcherbakov
* @since  0.0.1
* @version 0.0.1
*/
class Polyglot
{

	/**
	* current language
	* @property Lang $_lang
	*/
	private $_lang;

	/**
	* Session key in which to store the current language.
	* @property string  $_key
	*/
	private $_key = '_lang';
	
	public function __construct(){
		$session = new Session();
		$session->open();
		$isKey = isset($session[$this->_key]);
		if ($isKey){
			$lang =  Lang::find()->where(['name' => $session[$this->_key]])->one();
		}
		if (!isset($lang)){
			$lang = Lang::getDefault();
			$session[$this->_key] = $lang->name;
		}
		$this->_lang = $lang;
		$session->close();
	}

	/**
	* _lang getter.
	* @return Lang
	*/
	public function getLang(){
		return $this->_lang;
	}

	/**
	* _lang setter.
	* @param Lang $lang
	* @return void
	*/
	public function setLang(Lang $lang){
		$this->_lang = $lang;
	}


}