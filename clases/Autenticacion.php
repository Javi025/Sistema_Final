<?php
/* Se define una clase llamada Auth. */
// Su única responsabilidad es manejar la sesión del usuario (si está o no logueado, y permitir cerrar sesión).
class Autenticacion{
    /* Método estaAutenticado() */
    // Este método verifica si el usuario está autenticado.
    // Usa isset() para saber si existe $_SESSION['usuario_id'], lo que indica que el login fue exitoso.
    // Devuelve true si el usuario está logueado, o false si no.
    // static: el método se puede usar sin crear un objeto.
    public static function estaAutenticado(): bool {
        return isset($_SESSION['usuario_id']);
    }
    /* Método cerrarSesion() */
    // Este método cierra la sesión del usuario.
    // session_unset() borra las variables.
    // session_destroy() borra completamente la sesión activa.
    public static function cerrarSesion(): void {
        session_unset();// Limpia todas las variables de sesión
        session_destroy();// Destruye la sesión
    }
    /* Método obtenerEmail() */
    // Este método devuelve el email del usuario actual si está logueado.
    // Usa el operador ?? para devolver null si no existe.
    public static function obtenerEmail(): ?string {
        return $_SESSION['usuario_email'] ?? null;
    }
}

/* Apunte */

/*
La función isset()
Verifica si una variable está definida y no es NULL. 
Devuelve true si la variable existe y tiene un valor distinto de NULL, y false en caso contrario. 
Es útil para evitar errores al intentar acceder a variables no inicializadas o que han sido eliminadas con unset(). 

En detalle:

* Comprobación de existencia: isset() comprueba si una variable existe en la memoria, es decir, si ha sido declarada o asignada. 
* Valor distinto de NULL: isset() solo devuelve true si la variable no es NULL. NULL es un valor especial que indica la ausencia de valor. 
* Evita errores: Al usar isset() antes de acceder a una variable, 
                                 se evita que se produzcan errores que podrían ocurrir si se intenta acceder a una variable que no ha sido definida o que es NULL. 
* Sintaxis: isset($variable) o isset($var1, $var2, ...).

public static function 
Declara un método estático de una clase. 
Esto significa que el método puede ser llamado directamente usando la clase sin necesidad de crear una instancia de ella. 
Los métodos estáticos están asociados a la clase misma, no a una instancia específica.

En detalle:

public: Indica que el método es accesible desde cualquier lugar (incluyendo fuera de la clase). 
static: Define el método como estático, lo que significa que puede ser llamado sin una instancia de la clase. 
function: Indica que se trata de una función (método). 
nombre_del_método: El nombre del método que se define. 
*/