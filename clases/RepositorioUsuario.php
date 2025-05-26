<?php
/* Se declara una clase llamada RepositorioUsuario. Su responsabilidad única es trabajar con la base de datos (guardar y buscar usuarios). */
class RepositorioUsuario{
    /* Se declara una propiedad privada $conexion, que almacenará el objeto mysqli. */
    private $conexion;
    /* Constructor e inyección de dependencia */
    // El método __construct recibe como parámetro un objeto mysqli.
    // Eso se llama inyección de dependencia: en lugar de crear la conexión dentro de esta clase, se la pasamos desde afuera (más limpio y reutilizable).
    public function __construct(mysqli $conexion) {
        // $this->conexion guarda ese objeto para usarlo en los métodos siguientes.
        $this->conexion = $conexion;
    }
    /* Método público que guarda un objeto ModeloUsuario en la base de datos. */
    // El parámetro $usuario debe ser de la clase ModeloUsuario.
    // Devuelve un bool: true si lo guardó, false si falló.
    public function guardar(ModeloUsuario $usuario): bool {// : bool, Tipo de valor que devuelve la función
        // Se define una consulta SQL. El signo ? indica que se usarán parámetros preparados (evita SQL injection).
        // $sql, variable que se utiliza para almacenar una sentencia SQL que se va a ejecutar una base de datos 
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        // Prepara la consulta con la conexión que ya tenemos.
        // prepare(), Prepara una consulta SQL con seguridad (protege contra inyecciones)
        $stmt = $this->conexion->prepare($sql);
        // Enlaza los valores reales a los ? de la consulta. "sss" indica que son 3 strings (string, string, string).
        // Usa los getters del objeto ModeloUsuario para obtener los datos.
        // bind_param("sss", ...), Une valores reales a los signos ? en SQL (s = string)
        $stmt->bind_param("sss", $usuario->getNombre(), $usuario->getEmail(), $usuario->getPasswordHash());
        // Ejecuta la consulta y devuelve true o false.
        // execute(), Ejecuta la consulta preparada
        return $stmt->execute();
    }
    /* Método obtenerPorEmail() */
    // Busca un usuario por su email.
    // Devuelve un objeto ModeloUsuario si lo encuentra, o null si no lo encuentra.
    public function obtenerPorEmail(string $email): ?ModeloUsuario {// : ?Usuario	Tipo de valor que devuelve la función
        // Prepara, enlaza y ejecuta una consulta para buscar al usuario por email.
        $sql = "SELECT id, nombre, email, password FROM usuarios WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        // Si encuentra una fila, crea un objeto ModeloUsuario con los datos de esa fila y lo retorna.
        // fetch_assoc(), Devuelve una fila de resultados como arreglo asociativo
        if ($fila = $resultado->fetch_assoc()) {
            // new ModeloUsuario(...), Crea un nuevo objeto ModeloUsuario con los datos obtenidos
            return new ModeloUsuario($fila['nombre'], $fila['email'], $fila['password'], $fila['id']);
        }
        // Si no encuentra ningún usuario con ese email, retorna null.
        return null;
    }
}

/* Apunte */

/*
$stmt se usa para referirse a un objeto de sentencia preparada de MySQLi. 
Las sentencias preparadas son una técnica que ayuda a prevenir la inyección SQL y mejora el rendimiento al optimizar la ejecución de consultas SQL. 
$stmt normalmente se crea usando la función mysqli_prepare() y luego se puede usar para ejecutar la consulta con parámetros.

Detalles:

¿Qué es $stmt? 
$stmt es una variable en PHP que contiene un objeto de tipo mysqli_stmt. Este objeto representa una consulta preparada en MySQLi.

¿Cómo se crea? 
Se crea normalmente usando la función mysqli_prepare(): 

¿Para qué se usa? 
$stmt se usa para realizar las siguientes acciones:
* $stmt->execute(): Ejecuta la consulta preparada. 
* $stmt->bind_param(): Vincula parámetros a la consulta. 
* $stmt->bind_result(): Vincula variables para obtener resultados. 
* $stmt->fetch(): Recupera los resultados de la consulta. 
* $stmt->close(): Cierra la sentencia preparada y libera recursos. 
*/
