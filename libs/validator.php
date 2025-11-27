<?php
class Validator {

    // Solo letras, acentos y espacios
    public static function name($value) {
        return preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($value));
    }

    // DNI: exactamente 8 dígitos numéricos
    public static function dni($value) {
        return preg_match("/^[0-9]{8}$/", trim($value));
    }

    // CUIL: formato 00-00000000-0 (o sin guiones)
    public static function cuil($value) {
        return preg_match("/^\d{2}-?\d{8}-?\d{1}$/", trim($value));
    }

    // Email válido (usa filtro nativo)
    public static function email($value) {
        return filter_var(trim($value), FILTER_VALIDATE_EMAIL);
    }

    // Teléfono: permite números, espacios, guiones y +
    public static function phone($value) {
        return preg_match("/^[0-9+\-\s]{7,20}$/", trim($value));
    }

    // Dirección: letras, números, espacios y ciertos signos
    public static function address($value) {
        return preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\.\,\#\-]+$/", trim($value));
    }

    // Usuario: solo letras y números, sin espacios, 4 a 20 caracteres
    public static function username($value) {
        return preg_match("/^[a-zA-Z0-9_]{4,20}$/", trim($value));
    }

    // Contraseña: al menos 8 caracteres, 1 número, 1 letra, 1 especial
    public static function password($value) {
        return preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $value);
    }

    // Campo obligatorio (no vacío)
    public static function required($value) {
        return isset($value) && trim($value) !== '';
    }
}
?>