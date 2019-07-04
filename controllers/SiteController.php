<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PersonaForm;
// Adicionar los modelos
use app\models\PersonaAjaxForm;
use yii\widgets\activeForm;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHola(){
        return $this->render('hola');
    }

    public function actionSaluda(){
        $mensaje = 'Juan Perez';
        $data = ['mensaje' => $mensaje];
        return $this->render('saluda', $data);
    }

    public function actionArray(){
        $titulo = 'Lista de Estudiantes';
        $estudiantes = [
            ['id' => 1, 'nombre' => 'Mateo', 'edad' => 45],
            ['id' => 2, 'nombre' => 'Marcos', 'edad' => 12],
            ['id' => 3, 'nombre' => 'Lucas', 'edad' => 25],
            ['id' => 4, 'nombre' => 'Juan', 'edad' => 37],
        ];
        $data = [
            'titulo' => $titulo,
            'estudiantes' => $estudiantes
        ];
        return $this->render('lista', $data);
    }

    public function actionParametros($nombre = 'Ninguno'){
        $titulo = 'Paso de Parametros';
        $data = [
            'titulo' => $titulo,
            'nombre' => $nombre
        ];
        return $this->render('parametros', $data);
    }
    
    // Mostrar el formulario
    public function actionFormulario($mensaje = null) {
        $data = [
            'mensaje' => $mensaje
        ];
        return $this->render('formulario', $data);
    }
    // Recibir datos del formulario
    public function actionSolicitar() {
        $mensaje = null;
        if(isset($_REQUEST['nombre'])){
            $mensaje = 'El nombre enviado es '.$_REQUEST['nombre'];
        }
        $this->redirect(['site/formulario', 'mensaje' => $mensaje]);
    }

    // Validar formulario
    public function actionValidarformulario(){
        // Crear la instancia del modelo
        $model = new PersonaForm;
        // Si existen datos enviados por post
        if($model->load(Yii::$app->request->post())){
            // Si el formulario es valido
            if($model->validate()) {
                // Tareas como guardar en la BD
            } else {
                // Obtener los errores
                $model->getErrors();
            }
        }
        return $this->render('validarformulario', ['model' => $model]);
    } 

    // Validar formulario con ajax
    public function actionValidarformularioajax(){
        // Incluir la instancia del modelo
        $model = new PersonaAjaxForm();
        // Crear variable para mostrar mensaje
        $msg = null;
        // Si el formulario es enviado via ajax
        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                // Tareas como guardar en la BD
                $msg = 'Formulario enviado correctamente.';
                // Limpiar los campos
                $model->nombre = null;
                $model->email = null;
            } else {
                $model->getErrors();
            }
        }
        $data=[
            'model' => $model,
            'msg' => $msg
        ];
        return $this->render('validarformularioajax', $data);
    }

}
