<?php

namespace app\models;

use Yii;
use yii\base\model;

class SearchForm extends model
{

    public $q;
    
    public function rules()
    {
        return [
            ["q", "match", "pattern" => "/^[0-9a-záéíóúñ\s]+$/i", "message" => "Sólo se aceptan letras y numeros"]
        ];
    }

    public function attributeLabels() {
        return [
            'q' => 'Buscar:',
        ];
    }
}
