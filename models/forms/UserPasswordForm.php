<?php

namespace app\models\forms;

use Yii;

class UserPasswordForm extends \yii\base\Model
{
    public $plainTextPassword;
    public $plainTextPasswordConfirm;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'plainTextPassword'        => Yii::t('app', 'New Password'),
            'plainTextPasswordConfirm' => Yii::t('app', 'Confirm Password'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['plainTextPassword', 'required'],
            ['plainTextPassword', 'string', 'min' => 8],
            ['plainTextPasswordConfirm', 'compare', 'compareAttribute' => 'plainTextPassword'],
        ];
    }

    /**
     * Update the password of the given user.
     *
     * @param \app\models\User $user
     *
     * @return bool
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function updatePassword(\app\models\User $user)
    {
        if (!$this->validate()) {

            return false;
        }

        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->plainTextPassword);

       return $user->save();
    }
}