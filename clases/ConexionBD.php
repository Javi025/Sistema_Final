<?php
/* Se declara una clase llamada Conexion. */
// Una clase es una plantilla para crear objetos. Agrupa datos (propiedades) y comportamientos (métodos).
class ConexionBD {

    /* Se definen propiedades privadas con los datos de conexión a la base de datos: */
    // Modificadores de acceso que controlan la visibilidad de los miembros (atributos y métodos) de una clase. 
    // private significa que solo esa clase puede acceder a la propiedad. Nadie más desde fuera puede tocarla.
    private $host = 'localhost';// host: dirección del servidor MySQL (usualmente 'localhost').
    private $usuario = 'root';// usuario: nombre de usuario del servidor (por defecto, 'root').
    private $password = '1234';// password: la contraseña (vacía en entornos locales).
    private $baseDatos = 'sistema_final';// baseDatos: nombre de la base de datos.

    /* Declarar un método público llamado "obtener" que devuelve un objeto mysqli. */
    // public significa que puedes usarla desde fuera de la clase.
    // function: Indica que se trata de una función (método). 
    // Se espera que obtener() devuelva un objeto de tipo mysqli.
    // : tipoDeDato – Tipado de retorno, indica qué tipo de valor se devolverá.
    // Significa: "cuando alguien quiera una conexión, le daré una instancia lista de mysqli".
    // Crea una nueva conexión a MySQL usando los datos almacenados en la clase.
    public function obtener(): mysqli {
        /* Crea una nueva conexión a MySQL usando los datos almacenados en la clase. */
        // $conn es una variable. Almacena un objeto de la clase mysqli, esa clase se usa para conectarse a bases de datos MySQL.
        // new – Crear una nueva instancia (objeto), crea un objeto a partir de una clase. Se esta creando una nueva conexión a MySQL.
        // pseudo-variable $this – Acceder a propiedades de la misma clase, se refiere al objeto actual. Se usa para acceder a sus propios atributos o métodos.
        // -> es el operador de acceso a miembros de un objeto. Se usa para acceder a propiedades o métodos de un objeto.
        $conn = new mysqli($this->host, $this->usuario, $this->password, $this->baseDatos);
        /* Si ocurre un error de conexión, lanza una excepción. Es una forma de manejar errores sin romper el código. */
        // if y throw – Validar y lanzar errores
        // if: estructura condicional (si pasa esto, haz aquello).
        // throw: lanza una excepción si algo falla.
        // connect_error es una propiedad del objeto mysqli. Almacena el mensaje de error si falló la conexión a la base de datos.
        if ($conn->connect_error) {
            // . es el operador de concatenación.
            // Se usa para unir textos (strings).
            throw new Exception('Error de conexión: ' . $conn->connect_error);
        }
        /* Devuelve la conexión ya lista para ser usada en otras partes del sistema. */
        // Devolver un valor desde una función o método
        // Devuelve un resultado desde una función. Quien llame a esa función recibirá ese valor.
        return $conn;
    }
}
