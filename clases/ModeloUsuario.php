<?php
/* Se declara una clase llamada Usuario, que representa un usuario del sistema. */
class ModeloUsuario {
    /* Se definen 4 propiedades privadas */
    //  private: Estas propiedades no se pueden modificar directamente desde fuera (encapsulamiento).
    private $id; // ID del usuario (número entero).
    private $nombre;// nombre del usuario.
    private $email;// dirección de correo electrónico.
    private $passwordHash;// contraseña en formato encriptado.

    /* Método especial que se ejecuta automáticamente cuando se crea el objeto. */
    // Recibe 4 parámetros:
    // string $nombre: debe ser un texto.
    // string $email: debe ser un texto.
    // string $passwordHash: texto (contraseña encriptada).
    // int $id: número entero.
    // public function, Método que puede ser usado desde fuera  
    // __construct(), Método constructor que se ejecuta al crear el objeto
    public function __construct(string $nombre, string $email, string $passwordHash, int $id = null) {// Esto permite que puedas crear el objeto sin tener el ID aún. 
                                                                                                      // Más adelante, cuando recuperes el usuario de la base de datos (que ya tiene ID), puedes pasárselo.
        // Se asignan los valores recibidos a las propiedades del objeto usando $this->.
        // $this = se refiere al objeto que se está creando.
        $this->nombre = $nombre;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->id = $id;
    }
    /*  Estos métodos se llaman getters y son útiles para acceder a propiedades de forma segura. */
    // : tipoDeDato	Define el tipo de valor que la función devuelve
    public function getId(): ?int { return $this->id; }// Método que devuelve el ID del usuario. El tipo ?int significa que puede devolver un número entero o null.
    public function getNombre(): string { return $this->nombre; }// Devuelve el nombre del usuario.
    public function getEmail(): string { return $this->email; }// Devuelve el email del usuario.
    public function getPasswordHash(): string { return $this->passwordHash; }// Devuelve la contraseña encriptada del usuario.
}

/* Apunte */ 

/*
El getter:
 * Es un método que devuelve el valor de un atributo de la clase. 
 * Generalmente se nombra con el prefijo "get" seguido del nombre del atributo (ej: getNombre()). 
 * Permite obtener el valor del atributo sin tener que acceder directamente a él. 

El setter:
 * Es un método que permite asignar un valor a un atributo de la clase. 
 * Generalmente se nombra con el prefijo "set" seguido del nombre del atributo (ej: setNombre()). 
 * Permite modificar el valor del atributo de manera controlada. 
 * Puede incluir lógica de validación o procesamiento del valor antes de asignarlo.

método __construct() (constructor)
* El constructor __construct() debe ser público para que pueda ser llamado al crear instancias de la clase. 
* El constructor se encarga de la inicialización del objeto, como establecer valores iniciales a las propiedades o realizar cualquier configuración necesaria. 
* El constructor no devuelve un valor. 
* El constructor se llama automáticamente cuando se crea un nuevo objeto de la clase utilizando el operador new. 
*/