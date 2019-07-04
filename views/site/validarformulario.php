<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Validar Formulario</h1>
<?php $form  = ActiveForm::begin([
    'method' => 'post',              // Metodo
    'enableClientValidation' => true // Activar validacion por el lado del cliente
]); ?>
    <div class="form-group">
        <?php echo $form->field($model, 'nombre')->input('text'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->field($model, 'email')->input('email'); ?>
    </div>
    <?php echo Html::submitButton('Enviar', ['class' => 'btn btn-primary']); ?>
<?php $form->end(); ?>