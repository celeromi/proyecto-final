<?php
require_once __DIR__ . '/../configuraciones/config_sql.php';

echo "<h2>Test de configuración de la base de datos:</h2>";
echo "<h3><li>DB_HOST → " . DB_HOST . "</li></h3>";
echo "<h3><li>DB_NAME → " . DB_NAME . "</li></h3>";
echo "<h3><li>DB_USER → " . DB_USER . "</li></h3>";
echo "<h3><li>DB_PASS → " . (DB_PASS === '' ? '[vacía]' : DB_PASS) . "</li></h3>";
?>
