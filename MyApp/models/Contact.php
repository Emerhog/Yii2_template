<?php 

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{
    public function rules() {
        return [
            // удалить пробелы для полей name и email
            [['title', 'content'], 'trim'],
        ];
    }
}