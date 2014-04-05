<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teresa_admin".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $avatar
 * @property string $loginName
 * @property string $hash
 * @property integer $role
 * @property integer $addedBy
 * @property string $creationTime
 * @property integer $updatedBy
 * @property string $updateTime
 * @property string $lastLogin
 *
 * @property Admin $updatedBy0
 * @property Admin[] $admins
 * @property Admin $addedBy0
 * @property TeresaCategory[] $teresaCategories
 * @property TeresaCategoryProduct[] $teresaCategoryProducts
 * @property TeresaManufacturer[] $teresaManufacturers
 * @property TeresaProduct[] $teresaProducts
 */
class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    private $_id = false;
    private $_authKey = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teresa_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'loginName', 'hash', 'creationTime'], 'required'],
            [['role', 'addedBy', 'updatedBy'], 'integer'],
            [['creationTime', 'updateTime', 'lastLogin'], 'safe'],
            [['name', 'surname'], 'string', 'max' => 50],
            [['avatar'], 'string', 'max' => 200],
            [['loginName'], 'string', 'max' => 20],
            [['hash'], 'string', 'max' => 256],
            [['loginName'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'avatar' => Yii::t('app', 'Avatar'),
            'loginName' => Yii::t('app', 'Login Name'),
            'hash' => Yii::t('app', 'Hash'),
            'role' => Yii::t('app', 'Role'),
            'addedBy' => Yii::t('app', 'Added By'),
            'creationTime' => Yii::t('app', 'Creation Time'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'updateTime' => Yii::t('app', 'Update Time'),
            'lastLogin' => Yii::t('app', 'Last Login'),
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
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['addedBy' => 'id']);
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
    public function getTeresaCategories()
    {
        return $this->hasMany(TeresaCategory::className(), ['addedBy' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaCategoryProducts()
    {
        return $this->hasMany(TeresaCategoryProduct::className(), ['addedBy' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaManufacturers()
    {
        return $this->hasMany(TeresaManufacturer::className(), ['addedBy' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaProducts()
    {
        return $this->hasMany(TeresaProduct::className(), ['addedBy' => 'id']);
    }

    /**
     * Finds admin user by login name
     *
     * @param  string      $LoginName
     * @return Admin|null
     */
    public static function findByLoginName($loginName)
    {
        return Admin::find()->where(['loginName' => $loginName]);
    }

    /**
    * Checks the the password validy and sets id.
    * @param     string    $pswd
    * @return    boolean
    *
    */
    public function validatePassword($pswd){
        $isCorrect = password_verify($pswd, $this->hash);
        if ($isCorrect){
            $this->_id = $this->id;
            $auth = $this->hash;//str_split(password_hash($this->id, PASSWORD_DEFAULT));
            // shuffle($auth);
            $this->_authKey = $auth;
            // echo implode(' ', [$this->id, $this->_authKey]);
            // die();
        }
        return $isCorrect;
    }

    /**
    * Returns an Admin with the requested id or Null if no admin with such id exists.
    * @param    integer   id
    * @return   Admin|Null
    */
    public static function findIdentity($id){
        return Admin::find($id);
    }

    public function getId(){
        // echo __FUNCTION__."<br />". $this->_id;

        return $this->_id;
    }

    public function getAuthKey(){
        return $this->_authKey;
    }

    public function validateAuthKey($auth){
        return $this->_authKey == $auth; 
    }

    public static function findIdentityByAccessToken($token){
        $user = Admin::find()->where(['hash' => $token])->one();
        // print_r($user);
        // die();
        return $user;
    }
}
