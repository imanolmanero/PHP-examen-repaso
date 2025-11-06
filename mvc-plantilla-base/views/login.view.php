<?php require_once('layout/head.php') ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <h5>Iniciar Sesion</h5>
        <form action="index.php?controller=AuthController&accion=authenticate" method="POST">
            <input type="text" name="username" placeholder="Usuario" class="form-control mb-2" required>
            <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2" required>
            <input type="submit" class="btn btn-primary btn-block" value="Entrar">
        </form>
        <hr>
        <small class="text-muted">
            Usuarios: admin/admin123 o doctor/doctor123
        </small>
    </div>


</div>


<?php require_once('layout/footer.php') ?>