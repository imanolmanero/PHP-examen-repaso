<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/PacienteModel.php';

class PacienteController extends BaseController {
    
    /**
     * Mostrar listado de pacientes (página principal)
    */
    public function index() {
        $pacientes = PacienteModel::getAll();

        $idioma = $_COOKIE['idioma'] ?? 'es';

        $this->render('index.view.php',[
            'pacientes' =>$pacientes,
            'idioma' =>$idioma
        ]);
    }
    
    public function show() {
        
    }
    
    public function store() {
        
    }
    
    public function destroy() {
        
    }
    
    public function destroyAll() {
        
    }

    /**
     * Cambiar idioma (ejemplo de uso de cookies)
    */
    public function cambiarIdioma(){
        $idioma = $_GET['idioma'] ?? 'es';

        setcookie('idioma',$idioma,time() + (86400 * 30), '/');

        $_SESSION['mensaje'] = 'Idioma cambiado a: ' . ($idioma);
        $this->redirect('index.php');
    }
}