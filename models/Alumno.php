<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Alumno extends ActiveRecord {

    // Metodo para incluir la base de datos
    public static function getDb() {
        return Yii::$app->db;
    }

    // Metodo para incluir nombre de la tabla
    public static function tableName(){
        return 'alumnos';
    }
}
