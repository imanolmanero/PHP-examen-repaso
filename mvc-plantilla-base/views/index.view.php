<?php require_once('layout/head.php') ?>

<div class="row">
    <div class="col-md-8"><!-- Columna Tabla de pacientes -->
        <h5>Listado de Pacientes</h5>

        <!-- Tabla de pacientes -->
         <table class="table">
            <thead>
                <tr>
                    <td>DNI</td>
                    <td>Nombre</td>
                    <td>Apellidos</td>
                    <td>Opciones</td>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($pacientes as $paciente): ?>
                <tr>
                    <td><?= $paciente->dni ?></td>
                    <td><?= $paciente->nombre ?></td>
                    <td><?= $paciente->apellidos ?></td>
                </tr>

            <?php endforeach; ?>
            </tbody>
         </table>
        

        
    </div><!-- fin: Columna Tabla -->

    
</div>

<?php require_once('layout/footer.php') ?>