<?php
/* Se declara la clase ServicioRegistro  que se encargará solo del registro de usuarios. */
// Tiene una propiedad privada $repositorio, que guardará una instancia del repositorio para interactuar con la base de datos.
class ServicioRegistro {
    private $repositorio;// Propiedad privada para almacenar una dependencia
    /* Constructor con inyección de dependencia */
    // El constructor recibe un objeto de tipo RepositorioUsuario.
    // Lo almacena en la propiedad privada $repositorio para usarlo más adelante.
    // Esto se llama inyección de dependencias y permite que esta clase no esté acoplada a una clase específica, haciendo el sistema más flexible.
    public function __construct(RepositorioUsuario $repositorio) {// Recibe e inyecta una instancia desde fuera (inyección de dependencias)
        $this->repositorio = $repositorio;
    }
    /* Método registrar() */
    // Este método público se usa para registrar un nuevo usuario.
    // Recibe 3 valores como texto: nombre, email y contraseña.
    // Devuelve true si el registro fue exitoso, o false si falló.
    public function registrar(string $nombre, string $email, string $password): bool {// : bool	Indica que el método registrar() devuelve un true o false
        // Encriptar la contraseña
        // password_hash() encripta la contraseña usando un algoritmo seguro.
        // PASSWORD_DEFAULT elige automáticamente el mejor algoritmo disponible (actualmente bcrypt).
        // El valor resultante se guarda como $passwordHash.
        // Esto protege al usuario: nunca se guarda la contraseña en texto plano.
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // Crear el objeto Usuario
        // Se crea un nuevo objeto Usuario con los datos proporcionados.
        // Como el ID aún no existe (la base de datos lo genera automáticamente), no se pasa.
        $usuario = new ModeloUsuario($nombre, $email, $passwordHash);
        // Guardar en la base de datos
        // Llama al método guardar() del repositorio y le pasa el objeto Usuario.
        // Si el usuario se guarda correctamente, devuelve true.
        return $this->repositorio->guardar($usuario);
    }
}
