<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $user_id
 * @property string $restaurant_id
 * @property string $username
 * @property string $password
 * @property string $access_token
 * @property string $auth_key
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $user_group
 * @property integer $active
 *
 * @property Restaurant $restaurant
 * @property string $restaurantNameEnCa
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'username', 'password', 'access_token', 'auth_key', 'name', 'email', 'phone', 'user_group', 'active'], 'required'],
            [['restaurant_id', 'active'], 'integer'],
            [['user_group'], 'string'],
            [['username', 'name', 'email'], 'string', 'max' => 200],
            [['password'], 'string', 'max' => 100],
            [['access_token', 'auth_key'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 20],
            [['access_token'], 'unique'],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id'            => Yii::t('app', 'User ID'),
            'restaurant_id'      => Yii::t('app', 'Restaurant'),
            'username'           => Yii::t('app', 'Username'),
            'password'           => Yii::t('app', 'Password'),
            'access_token'       => Yii::t('app', 'Access Token'),
            'auth_key'           => Yii::t('app', 'Auth Key'),
            'name'               => Yii::t('app', 'Name'),
            'email'              => Yii::t('app', 'Email'),
            'phone'              => Yii::t('app', 'Phone'),
            'user_group'         => Yii::t('app', 'User Group'),
            'active'             => Yii::t('app', 'Active'),
            'restaurantNameEnCa' => Yii::t('app', 'Restaurant'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['restaurant_id' => 'restaurant_id']);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $userId the ID to be looked for
     *
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($userId)
    {
        return static::findOne($userId);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     *
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     *
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @return null|string
     */
    public function getRestaurantNameEnCa()
    {
        return $this->restaurant->name_en_ca;
    }
}
