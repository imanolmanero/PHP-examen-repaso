<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/UserModel.php';
/**
 * AuthController - Gestión de autenticación
 * Maneja login y logout
 */

class AuthController extends BaseController {
    
    /**
     * Mostrar formulario de login
     * Este método muestra el formulario de inicio de sesión, pero si el usuario ya ha iniciado sesión, lo redirige automáticamente a la página principal.
    */
    public function login() {
        if(isset($_SESSION['user'])){
            $this->redirect('index.php');
        }

        $this->render('login.view.php');
    }

    /**
     * Procesar el login (autenticar)
    */
    
    public function authenticate() {
        // Obtener datos del formulario
        //quiero guardar en $username el campo que hay en el formulario que se llama username
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validar credenciales usando el array
        // Cambia a validateLoginDB() si prefieres usar la base de datos
        $usuario = UserModel::validateLoginDB($username,$password);

        if($usuario){
            // Login exitoso: guardar en sesión
            $_SESSION['user'] = $usuario;
            $_SESSION['mensaje'] = 'Bienvenido, ' . $usuario['nombre_completo'];
            $this->redirect('index.php');
            exit();
        }else{
            // Login fallido: volver al formulario
            $_SESSION['error'] = 'Usuario o contraseña incorrectos';
            $this->redirect('index.php?controller=AuthController&accion=login');
        }
    }
    
    /**
     * Cerrar sesión
    */
    public function logout() {
        // Destruir la sesión
        session_destroy();

        // Redirigir al login
        $this->redirect('index.php?controller=AuthController&accion=login');
    }
    
}