<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Validar Formulario Ajax</h1>

<!-- Mostrar mensaje -->
<h3><?php echo $msg; ?></h3>

<?php $form  = ActiveForm::begin([
    'id' => 'formulario',             // Identificador
    'method' => 'post',               // Metodo
    'enableClientValidation' => false,// Desactivar validacion por el lado del cliente
    'enableAjaxValidation' => true    // Activar validacion ajax
]); ?>
    <div class="form-group">
        <?php echo $form->field($model, 'nombre')->input('text'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->field($model, 'email')->input('email'); ?>
    </div>
    <?php echo Html::submitButton('Enviar', ['class' => 'btn btn-primary']); ?>
<?php $form->end(); ?>