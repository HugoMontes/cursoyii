<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// Adicionar los modelos de paginacion
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>

<a href="<?php echo Url::toRoute("alumno/create"); ?>">Nuevo Alumno</a>

<?php $f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("alumno/index"),
    "enableClientValidation" => true,
]); ?>
<div class="form-group">
    <?php echo $f->field($form, "q")->input("search"); ?>
</div>
<?php echo Html::submitButton("Buscar", ["class" => "btn btn-primary"]); ?>
<?php $f->end(); ?>
<h3><?php echo $search; ?></h3>


<h3>Lista de Alumnos</h3>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Clase</th>
        <th>Nota Final</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($model as $row) { ?>
        <tr>
            <td><?php echo $row->id_alumno; ?></td>
            <td><?php echo $row->nombre; ?></td>
            <td><?php echo $row->apellidos; ?></td>
            <td><?php echo $row->clase; ?></td>
            <td><?php echo $row->nota_final; ?></td>
            <td>
                <a href="#">Editar</a> |
                <!-- modal eliminar -->
                <a href="#" data-toggle="modal" data-target="#id_alumno_<?= $row->id_alumno ?>">Eliminar</a>
                <div class="modal fade" role="dialog" aria-hidden="true" id="id_alumno_<?= $row->id_alumno ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Eliminar alumno</h4>
                            </div>
                            <div class="modal-body">
                                <p>¿Realmente deseas eliminar al alumno con id <?= $row->id_alumno ?>?</p>
                            </div>
                            <div class="modal-footer">
                                <?= Html::beginForm(Url::toRoute("alumno/delete"), "POST") ?>
                                <input type="hidden" name="id_alumno" value="<?= $row->id_alumno ?>">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Eliminar</button>
                                <?= Html::endForm() ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.modal eliminar -->
            </td>
        </tr>
    <?php } ?>
</table>

<!-- Adicionar botones de paginacion -->
<?php
echo LinkPager::widget([
    "pagination" => $pages,
]);
?>