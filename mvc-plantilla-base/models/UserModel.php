<?php
/**
 * Modelo User - Gestión de autenticación
 * Puede usar array asociativo o base de datos
 */
require_once __DIR__ . '/Database.php';

class UserModel {

    /**
     * Array de usuarios hardcodeado (opción simple para examen)
     * Contraseñas en texto plano solo para desarrollo/examen
    */

    private static $usuarios = [
        [
            'username' => 'admin',
            'password' => 'admin123',
            'nombre' => 'Administrador'
        ],
        [
            'username' => 'doctor',
            'password' => 'doctor123',
            'nombre' => 'Dr.Garcia'
        ]
    ];

    /**
     * Validar login con array asociativo
     * Devuelve los datos del usuario si es válido, false si no
     * Se us self porque: el método es static y accede a una propiedad estática ($usuarios)
    */
    public static function validateLoginArray($username,$password) {
        //Recorre el array de usuarios
        foreach(self::$usuarios as $usuario){
            if($usuario['username'] === $username & $usuario['password'] === $password){
                //Si el username y la password coinciden devolvemos el usuario sin contraseña
                return[
                    'username' => $usuario['username'],
                    'nombre' =>$usuario['nombre']
                ];
            }
        }
        //Si recorre todo el array y no encuentra coincidencia de ese user y pass devuelve false
        return false;
    }

    /**
     * Validar login con base de datos (alternativa)
     * Usa password_verify para contraseñas hasheadas
    */
    public static function validateLoginDB($username, $password) {
        $db = Database::getConnection();

        // Buscar el usuario por username
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->execute(['username' => $username]);

        // Obtener como array asociativo
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            return false;
        }

        // COMPARACIÓN EN TEXTO PLANO (solo para pruebas)
        if ($password === $usuario['password']) {
            return [
                'id' => $usuario['id'],
                'username' => $usuario['username'],
                'nombre' => $usuario['nombre_completo']
            ];
        }

        return false;
    }


    
    /**
     * =====================================================
     * OBTENER USUARIO POR USERNAME
     * =====================================================
     * Busca un usuario en la base de datos por su nombre de usuario
     * @param string $username Nombre de usuario
     * @return object|false Objeto usuario o false si no existe
    */
    public static function getByUsername($username) {
        $db = Database::getConnection();

        $sql = "SELECT * FROM usuarios WHERE username = :username";

        $stmt = $db-> prepare($sql);

        $stmt -> execute(['username'=>$username]);

        return $stmt->fetch();
    }
    

}