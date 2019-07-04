<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AlumnoForm;
use app\models\Alumno;
use app\models\SearchForm;
use yii\helpers\Html;
use yii\data\Pagination;
// Incluir la clase url para redireccionar
use yii\helpers\Url;

class AlumnoController extends Controller {
	
	// Funcion inicial o principal
	public function actionIndex() {
		// Variable para el modelo de validacion
		$form = new SearchForm();
		// Variable para el valor de la busqueda
		$search = null;
		// Variable para la cantidad de registros por pagina
		$pageSize = 1;
		// Si el formulario de busqueda fue enviado
		if($form->load(Yii::$app->request->get())) { 
			// La validacion es correcta
			if($form->validate()) {
				// Guardar busqueda de usuario
				$search = Html::encode($form->q);
				// Se genera la consulta diferente al anterior
				$table = Alumno::find()
					->where(["like","id_alumno", $search])
					->orWhere(["like", "nombre", $search])
					->orWhere(["like", "apellidos", $search]);
				// Clonar
				$count = clone $table;
				// Instancia de paginacion
				$pages = new Pagination([
					"pageSize" => $pageSize,
					"totalCount" => $count->count(),
				]);
				$model = $table
						->offset($pages->offset)
						->limit($pages->limit)
						->all();
			}else{
				$form->getErrors();
			}
		}else{
			// Mostrar todos los registros
			$table = Alumno::find();
			$count = clone $table;
			$pages = new Pagination([
				"pageSize" => $pageSize,
				"totalCount" => $count->count(),
			]);
			$model = $table
					->offset($pages->offset)
					->limit($pages->limit)
					->all();
		}
		// Enviar paginacion pages a la vista
		$data = [
			'model' => $model,
			'form' => $form,
			'search' => $search,
			'pages' => $pages
		];
		return $this->render('index', $data);
	}

	public function actionCreate() {
		// Instanciar modelo de formulario
		$model = new AlumnoForm();
		$msg = null;
		// Si el formulario es enviado mediante post
		if($model->load(Yii::$app->request->post())) {
			// Validar
			if($model->validate()) {
				// Asignar los valores del formulario al modelo
				$table = new Alumno();
				$table->nombre = $model->nombre;
				$table->apellidos = $model->apellidos;
				$table->clase = $model->clase;
				$table->nota_final = $model->nota_final;
				// Si insertamos correctamente
				if($table->insert()) {
					$msg = 'Registro guardado correctamente.';
					// Limpiar formulario
					$model->nombre = null;
					$model->apellidos = null;
					$model->clase = null;
					$model->nota_final = null;
				} else {
					$msg = 'Ha ocurrido un error al guardar.';
				}
			} else {
				$model->getErrors();
			}
		}
		// Pasar datos a la vista
		$data=[
			'msg' => $msg,
			'model' => $model
		];
		return $this->render('create', $data);
	}
	
	// Funcion para eliminar
	public function actionDelete(){
		// Si el formulario es enviado
		if(Yii::$app->request->post()) {
			// Obtener el id de alumno
			$idAlumno = Html::encode($_POST['id_alumno']);
			// Si el id es un entero
			if((int)$idAlumno){
				// Eliminar en la base de datos
				if(Alumno::deleteAll("id_alumno = :id_alumno", [":id_alumno"=>$idAlumno])){
					echo "Alumno con id $idAlumno eliminado con exito, redireccionando...";
					echo "<meta http-equiv='refresh' content='3; ".Url::toRoute('alumno/index')."'>";
				}else{
					// Redireccionar al listado
					echo "Ha ocurrido un error al eliminar, redireccionando....";
					echo "<meta http-equiv='refresh' content='3; ".Url::toRoute('alumno/index')."'>";	
				}
			}else{
				// Redireccionar al listado
				echo "Ha ocurrido un error al eliminar, redireccionando....";
				echo "<meta http-equiv='refresh' content='3; ".Url::toRoute('alumno/index')."'>";
			}
		}else{
			// Redireccionar al listado
			return $this->redirect(['alumno/index']);
		}
	}
}
