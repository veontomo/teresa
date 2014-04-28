<?php

namespace app\models;

use Yii;
use app\models\Manufacturer;

/**
 * This is the model class for table "teresa_manufacturer".
 *
 * @property string $_lang
 * @property string $id
 * @property string $url
 * @property integer $addedBy
 * @property string $creationTime
 * @property integer $updatedBy
 * @property string $updateTime
 *
 * @property TeresaAdmin $updatedBy0
 * @property TeresaAdmin $addedBy0
 * @property TeresaManufacturerValues $teresaManufacturerValues
 */
class Manufacturer extends \yii\db\ActiveRecord
{

    /**
    * current language
    * @type   Lang
    */
    private $_lang; // initialize this variable in the constructor

    /**
    * Initialize _lang property. 
    *
    * Look for language name in the following order:
    * 1. in SESSION:  it should contain "_lang" key,
    * 2. in application parameters: configuration array should contain 'defaultLang' key.
    * If the language name is found and it corresponds to a record  present in Lang db, 
    * then use this record as current language. Otherwise, picks up default language from
    * Lang db.
    * If the '_lang' key was not set in the SESSION, set it up.
    */
    // public function __construct(){
    //     $langIsSet = isset(Yii::$app->session['_lang']);
    //     $defaultLangName =  $langIsSet ? Yii::$app->session['_lang'] : Yii::$app->params['defaultLang'];
    //     if ($defaultLangName){
    //         $lang = Lang::find()->where(['name' => $defaultLangName])->one();
    //     };
    //     $this->_lang =  (isset($lang) && $lang) ? $lang : Lang::getDefault();
    //     if (!$langIsSet){
    //         Yii::$app->session['_lang'] = $this->_lang->name;
    //     }
    // }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teresa_manufacturer';
    }

    /**
    * Name of the table containing attribute names that depened on language
    * @return 'teresa_manufacturer_attrs'
    */
    public static function tableAttrs()
    {
        return 'teresa_manufacturer_attrs';
    }

    /**
    * Name of the table containing translations of the attributes
    * @return 'teresa_manufacturer_values'
    */
    public static function tableValues()
    {
        return 'teresa_manufacturer_values';
    }


    /**
    * Language getter.
    * @return string
    */ 
    public function getLang()
    {
        return $this->_lang;
    }

    /**
    * Language setter.
    * @param string   $lang   
    * @return string
    */ 
    public function setLang(Lang $lang)
    {
        $this->_lang = $lang;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['addedBy', 'updatedBy'], 'integer'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'addedBy' => Yii::t('app', 'Added By'),
            'creationTime' => Yii::t('app', 'Creation Time'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'updateTime' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy0()
    {
        return $this->hasOne(Admin::className(), ['id' => 'updatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy0()
    {
        return $this->hasOne(Admin::className(), ['id' => 'addedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaManufacturerValues()
    {
        return $this->hasOne(TeresaManufacturerValues::className(), ['id' => 'id']);
    }
}
