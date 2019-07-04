<?php 
namespace app\models;

use Yii;
use yii\base\Model;

class PersonaForm extends Model{
    
    // Adicionar los atributos para el formulario
    public $nombre;
    public $email;

    // Adicionar las reglas de validacion
    public function rules(){
        return [
            // indicar que el campo nombre es requerido
            ['nombre', 'required', 'message' => 'Campo requerido'],
            // match aplica expresion regular para cantidad de caracteres
            ['nombre', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Minimo 3 y maximo 50 caracteres'],
            // aplicamos filtro para que se ingrese unicamente numeros y letras
            ['nombre', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Solo se aceptan letras y numeros'],
            
            // indicar que el campo email es requerido
            ['email', 'required', 'message' => 'Campo requerido'],
            // match aplica expresion regular para cantidad de caracteres
            ['email', 'match', 'pattern' => "/^.{3,80}$/", 'message' => 'Minimo 5 y maximo 80 caracteres'],
            // formato de correo
            ['email', 'email', 'message' => 'Formato no valido'],
        ];
    }

    // Cambiar el texto de las etiquetas
    public function attributeLabels(){
        return [
            'nombre' => 'Nombre: ',
            'email' => 'Email: ',
        ];
    }
}