<?php

declare(strict_types=1);

namespace infrastructure\entity\activeRecord;

use yii\db\ActiveRecord;

class AccessToken extends ActiveRecord
{
    public static function tableName()
    {
        return 'access_token';
    }

    public function rules()
    {
        return [
            [['token'], 'required'],
            [['token'], 'string', 'max' => 255],
        ];
    }
}
