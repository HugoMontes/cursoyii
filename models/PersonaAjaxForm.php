<?php 
namespace app\models;

use Yii;
use yii\base\Model;

class PersonaAjaxForm extends Model{
    
    public $nombre;
    public $email;

    public function rules(){
        return [
            ['nombre', 'required', 'message' => 'Campo requerido'],
            ['nombre', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Minimo 3 y maximo 50 caracteres'],
            ['nombre', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Solo se aceptan letras y numeros'],
            
            ['email', 'required', 'message' => 'Campo requerido'],
            ['email', 'match', 'pattern' => "/^.{3,80}$/", 'message' => 'Minimo 5 y maximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no valido'],

            // Agregar validacion en los roles
            ['email', 'email_existe'],
        ];
    }

    public function attributeLabels(){
        return [
            'nombre' => 'Nombre: ',
            'email' => 'Email: ',
        ];
    }

    // Crear un metodo que verifica si el email existe
    public function email_existe($attribute, $params){
        // Simular una consulta a base de datos
        $email = ['juan@gmail.com', 'maria@gmail.com'];
        foreach($email as $val){
            // Buscar si existe el email
            if($this->email == $val) {
                // Mostrar mensaje de error
                $this->addError($attribute, 'El email seleccionado existe');
                return true;
            }else{
                return false;
            }
        }
    }
}