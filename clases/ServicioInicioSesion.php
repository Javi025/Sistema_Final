<?php
/* Se declara la clase LoginService, que se encargará de manejar el proceso de inicio de sesión */
// La propiedad privada $usuarioRepository almacenará una instancia de UsuarioRepository (es decir, el acceso a la base de datos).
class ServicioInicioSesion {
    private $repositorio;
    /* Constructor con inyección de dependencias */
    // Define el constructor __construct().
    // Recibe como parámetro un objeto UsuarioRepository, que se inyecta desde fuera.
    // Esto permite usar los métodos para buscar usuarios sin tener que conectarse directamente a la base de datos.
    public function __construct(RepositorioUsuario $repositorio) {
        $this->repositorio = $repositorio;
    }
    /* Método público llamado login. */
    // Recibe dos parámetros:
    // $email: el correo del usuario (tipo string).
    // $password: la contraseña que el usuario escribió en el formulario.
    // El método devuelve un valor de tipo bool:
    // true si el login es correcto.
    // false si no lo es.
    public function iniciarSesion(string $email, string $password): bool {
        /* Buscar al usuario en la base de datos */
        // Usa el repositorio para buscar un usuario por su email.
        // Si encuentra un usuario, lo guarda como objeto en $usuario; si no, será null.
        $usuario = $this->repositorio->obtenerPorEmail($email);
        /* Verificar contraseña y crear sesión */
        // El if tiene dos condiciones:
        // ¿El usuario fue encontrado?
        // ¿La contraseña que escribió el usuario coincide con la que está en la base de datos?
        // password_verify($password, $usuario->getPasswordHash()) compara la contraseña normal con la contraseña encriptada que se guardó al registrarse.
        if ($usuario && password_verify($password, $usuario->getPasswordHash())) {
            /* Si la contraseña es correcta, crea una sesión para el usuario. */
            // Se guarda el id del usuario en $_SESSION['usuario_id'].
            // Y su email en $_SESSION['usuario_email'].
            // $_SESSION es una variable global de PHP que guarda datos del usuario mientras navega por la web.
            $_SESSION['usuario_id'] = $usuario->getId();
            $_SESSION['usuario_email'] = $usuario->getEmail();
            // Devuelve true para indicar que el inicio de sesión fue exitoso.
            return true;
        }
        /* Si no encuentra al usuario o la contraseña es incorrecta, se devuelve false. */
        return false;
    }
}
