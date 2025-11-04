<?php
/**
 * =====================================================
 * MODELO PACIENTE - CAPA DE DATOS
 * =====================================================
 * Este modelo contiene toda la lógica de acceso a datos
 * relacionada con la tabla 'pacientes'.
 * Implementa las operaciones CRUD completas.
 */
require_once __DIR__ . '/Database.php';

class PacienteModel {
    
    /**
     * =====================================================
     * SELECT - Obtener todos los pacientes
     * =====================================================
     * Devuelve un array con todos los registros de la tabla pacientes
     * @return array Array de objetos con los datos de los pacientes
    */

    public static function getAll() {
        // Obtenemos la conexión a la base de datos
        $db = Database::getConnection();

        // Preparamos la consulta SQL
        // Usamos ORDER BY para ordenar por apellidos y nombre
        $sql = "SELECT * FROM pacientes order by apellidos,nombre";

        // Preparamos la consulta (protección contra SQL injection)
        $stmt = $db->prepare($sql);

        // Ejecutamos la consulta
        $stmt->execute();

        // fetchAll() devuelve TODOS los resultados en un array
        // Como configuramos FETCH_OBJ en Database.php, cada elemento es un objeto
        return $stmt->fetchAll();
    }
    
    /**
     * =====================================================
     * SELECT BY ID - Obtener un paciente por su ID
     * =====================================================
     * Busca un paciente específico por su ID
     * @param int $id ID del paciente a buscar
     * @return object|false Objeto con los datos del paciente o false si no existe
    */

    public static function getById($id) {
       $db = Database::getConnection();

       // Usamos placeholder :id para evitar SQL injection
       $sql = "SELECT * FFROM pacientes where id = :id";

       $stmt = $db -> prepare($sql);

       $stmt-> execute();

        // fetch() devuelve UN SOLO resultado (no un array)
        // Devuelve false si no encuentra nada
       return $stmt->fetch();
    }
    
    /**
     * =====================================================
     * INSERT - Crear un nuevo paciente
     * =====================================================
     * Inserta un nuevo registro en la tabla pacientes
     * @param array $datos Array asociativo con los datos del paciente
     * @return bool True si se insertó correctamente, false en caso contrario
    */

    public static function create($datos) {
        $db = Database::getConnection();

        // SQL con placeholders para cada campo
        // No incluimos 'id' porque es AUTO_INCREMENT
        // No incluimos 'fecha_ingreso' porque tiene DEFAULT CURRENT_TIMESTAMP
        $sql = "INSERT INTO pacientes (nombre, apellidos, dni, fecha_nacimiento, telefono, email, direccion) 
                VALUES (:nombre, :apellidos, :dni, :fecha_nacimiento, :telefono, :email, :direccion)";

        $stmt = $db->prepare($sql);

        // Ejecuta la sentencia SQL reemplazando los placeholders con los valores del array $datos.
        // Devuelve true si la inserción se realizó correctamente o false si ocurrió un error.
        return $stmt->execute([
            'nombre' => $datos['nombre'],
            'apellidos' => $datos['apellidos'],
            'dni' => $datos['dni'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'],
            'telefono' => $datos['telefono'],
            'email' => $datos['email'],
            'direccion' => $datos['direccion'],
        ]);
    }
    
    public static function deleteById($id) {
        
    }
    
    public static function deleteAll() {
        
    }
}