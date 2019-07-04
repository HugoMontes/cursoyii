<h1><?php echo $titulo; ?></h1>
<table class="table">
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>EDAD</th>
    </tr>
    <?php foreach($estudiantes as $est){ ?>
    <tr>
        <td><?php echo $est['id']; ?></td>
        <td><?php echo $est['nombre']; ?></td>
        <td><?php echo $est['edad']; ?></td>
    </tr>
    <?php } ?>
</table>