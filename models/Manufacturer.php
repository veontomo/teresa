<?php

namespace app\models;

use Yii;
use app\models\Manufacturer;
use yii\elasticsearch\Query;

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
    private $_lang;

    public $test = 'test string';

    /**
    * Initialize _lang property.  
    *
    * It make use of "Polyglot" component in order to initialize 
    * private variable $_lang.
    */
    public function __construct(){
        $this->_lang = Yii::$app->polyglot->getLang();
    }

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

    /**
    * Returns records from 'teresa_manufacturer_values' table corresponding 
    * to current record in current language
    *
    */
    public function getValues()
    {   
        $id = $this->id;
        $langId = $this->getLang()->id;
        if ($id && $langId){
            $connection = \Yii::$app->db;
            $query = $connection->createCommand('SELECT * FROM ' . $this->tableValues() .
                ' WHERE lang=' . $langId . ' AND id=' . $id);
            return $query->queryAll();
        }
    }
}
