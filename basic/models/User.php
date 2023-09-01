<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $authKey
 * @property string|null $accessToken
 * @property string|null $fullname
 * @property string|null $email
 * @property string|null $contactNumber
 * @property string|null $role
 * @property int|null $isTenant
 * @property string|null $createDate
 * @property string|null $lastActiveDate
 */



 class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['role'], 'string'],
            [['isTenant'], 'integer'],
            [['createDate', 'lastActiveDate'], 'safe'],
            [['username', 'password', 'authKey', 'accessToken', 'fullname', 'email'], 'string', 'max' => 255],
            [['contactNumber'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'contactNumber' => 'Contact Number',
            'role' => 'Role',
            'isTenant' => 'Is Tenant',
            'createDate' => 'Create Date',
            'lastActiveDate' => 'Last Active Date',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->authKey = Yii::$app->security->generateRandomString();
                $this->accessToken = Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
}
