<?php
// IMPORTAR LAS CLASES DE AYUDA
use yii\helpers\Url;
use yii\helpers\Html;
?>

<h1>Formulario</h1>
<h3><?php echo $mensaje;?></h3>
<?php echo Html::beginForm(
    Url::toRoute('site/solicitar'), // action
    'get',                          // method
    ['class' => 'form']);            // options
?>         
    <div class="form-group">
        <?php echo Html::label('Introduce tu nombre', 'nombre');?>
        <?php echo Html::textInput('nombre', null, ['class' => 'form-control']);?>
    </div>
    <div class="form-group">
        <?php echo Html::submitInput('Enviar', ['class' => 'btn btn-primary']);?>
    </div>
<?php echo Html::endForm(); ?>