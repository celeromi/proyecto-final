<?php
session_start();
include 'mock_db.php';
include 'includes/header.php';

// Inicializar presupuesto si no existe
if (!isset($_SESSION['presupuesto'])) {
    $_SESSION['presupuesto'] = [
        'cliente' => '',
        'productos' => [],
        'total' => 0,
    ];
}

// Manejo de búsqueda de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto'])) {
    $productoBuscado = strtolower($_POST['producto']);
    $resultados = array_filter($productos, function ($producto) use ($productoBuscado) {
        return strpos(strtolower($producto['nombre']), $productoBuscado) !== false;
    });
}

// Manejo de agregar productos al presupuesto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    
    $producto = array_values(array_filter($productos, fn($p) => $p['id'] == $producto_id))[0];
    $subtotal = $producto['precio'] * $cantidad;
    
    $_SESSION['presupuesto']['productos'][] = [
        'nombre' => $producto['nombre'],
        'precio' => $producto['precio'],
        'cantidad' => $cantidad,
        'subtotal' => $subtotal,
    ];
    
    $_SESSION['presupuesto']['total'] += $subtotal;
}

// Manejo de finalización de presupuesto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cliente'])) {
    $_SESSION['presupuesto']['cliente'] = $_POST['cliente'];
    $total = $_SESSION['presupuesto']['total'];
    echo "<p>Presupuesto finalizado para el cliente: {$_SESSION['presupuesto']['cliente']}</p>";
    echo "<p>Total: $total</p>";
    unset($_SESSION['presupuesto']);
    echo "<a href='index.php'>Volver al inicio</a>";
    exit;
}
// Array con opciones (puede venir de una base de datos)
$opciones = ["Efectivo", "Mercado pago", "Debito", "Credito"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto</title>
    <link rel="stylesheet" href="assets/estilomodal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
h1 {
    text-align: center;
}

h2, h3 {
    text-align: center;
    color: black;
}

.formulario-datos-cliente {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  background: white;
  padding: 20px;
  margin: 0 auto 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  justify-content: flex-start;
  max-width: 1000px;
}

.form-row {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  width: 100%;
}

.form-group {
  display: flex;
  flex-direction: column;
  flex: 1 1 200px;
  min-width: 200px;
  margin-bottom: 10px;
}

.formulario-datos-cliente input,
.formulario-datos-cliente select {
  padding: 6px 8px;
  font-size: 14px;
}

.formulario-datos-cliente button {
  align-self: flex;
  margin-top: 5px;
  padding: 8px 20px;
  font-size: 14px;
}


.container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: nowrap;
    gap: 20px;
    max-width: 1000px;
    margin: auto;
}

.table-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 80%;
    min-width: 300px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

thead {
    background-color: #28a745;
    color: white;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    font-weight: bold;
}

form {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

label {
    color: black;
    font-weight: bold;
}

p{
    color: black;
}

input, button {
    padding: 8px;
    font-size: 16px;
}

button {
    background-color: #28a745;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    padding: 10px;
}
.cancel-btn {
    background-color: #dc3545;
    color: white;
}
</style>

<body>
    <h1>Nuevo Presupuesto</h1>

    <form class="formulario-datos-cliente">
  <div class="form-row">
    <div class="form-group">
      <label for="tipo_factura">Tipo de Factura:</label>
      <select id="tipo_factura" name="tipo_factura">
        <option value="A">Factura A</option>
        <option value="B">Factura B</option>
      </select>
    </div>

    <div class="form-group">
      <label for="fecha_emision">Fecha de Emisión:</label>
      <input type="date" id="fecha_emision" name="fecha_emision">
    </div>

    <div class="form-group">
      <label for="fecha_final">Fecha de Finalización:</label>
      <input type="date" id="fecha_final" name="fecha_final">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group" style="flex: 2;">
      <label for="buscar_cliente">Buscar Cliente:</label>
      <input type="text" id="buscar_cliente" name="buscar_cliente">
    </div>
    <div class="form-group" style="flex: none;">
      <label>&nbsp;</label>
      <button type="submit">Buscar Cliente</button>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre">
    </div>

    <div class="form-group">
      <label for="apellido">Apellido:</label>
      <input type="text" id="apellido" name="apellido">
    </div>

    <div class="form-group">
      <label for="direccion">Dirección:</label>
      <input type="text" id="direccion" name="direccion">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="telefono">Teléfono:</label>
      <input type="text" id="telefono" name="telefono">
    </div>

    <div class="form-group" style="align-self: flex-end;">
    </div>
  </div>
</form>


    <div class="container">
    <div class="table-container">
        <h2>Buscar y Agregar Productos</h2>
        <form action="" method="POST">
            <label for="producto">Buscar Producto:</label>
            <input type="text" name="producto" required>
            <button type="submit">Buscar</button>
        </form>

        <?php if (!empty($resultados)) : ?>
            <form action="" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $prod) : ?>
                            <tr>
                                <td><input type='radio' name='producto_id' value='<?= $prod['id'] ?>'></td>
                                <td><?= $prod['nombre'] ?></td>
                                <td><?= $prod['precio'] ?></td>
                                <td><input type='number' name='cantidad' min='1' required></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type='submit'>Añadir al presupuesto</button>
            </form>
        <?php endif; ?>
    </div>

    <div class="table-container">
        <h2>Presupuesto Actual</h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['presupuesto']['productos'] as $prod) : ?>
                    <tr>
                        <td><input type='radio' name='producto_id' value='<?= $prod['id'] ?>'></td>
                        <td><?= $prod['nombre'] ?></td>
                        <td><input type='number' name='cantidad' min='1' required></td>
                        <td><?= $prod['precio'] ?></td>
                        <td><?= $prod['subtotal'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><button class="cancel-btn" onclick="closeEditModal()">Borrar</button><p>
        <p1><strong>Total:</strong> <?= $_SESSION['presupuesto']['total'] ?></p1>

        <form action="" method="POST">
            <button class='action-btn edit-btn' onclick='openEditModal()'>Finalizar</button>
        </form>
    </div>
</div>
<div id="editModal" class="modal">
    <div class="modal-content">
        <h2>Datos Cliente</h2>
        
        <!-- Formulario con labels -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" value="">
        </div>
            
        <div class="form-group">
            <label for="stock">Direccion</label>
            <input type="text" id="stock" value="">
        </div>
        
        <div class="form-group">
            <label for="precio_unitario">Telefono</label>
            <input type="text" id="precio_unitario" value="">
        </div>

        <form method="POST" action="">
            <label for="seleccion">Forma de pago</label>
            <select name="seleccion" id="seleccion">
                <?php foreach ($opciones as $opcion): ?>
                    <option value="<?= $opcion ?>"><?= $opcion ?></option>
                <?php endforeach; ?>
            </select>
        </form>
        <div class="buttons">
            <button class="save-btn" onclick="saveChanges()">Guardar e imprimir</button>
            <button class="cancel-btn" onclick="closeEditModal()">Cancelar</button>
        </div>
    </div>
</div>

<script>

    // Funciones para manejar el modal de editar producto
    function openEditModal() {
        document.getElementById("editModal").style.display = "flex";
    }

    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }

    function saveChanges() {
        alert("Cambios guardados.");
        closeEditModal();
    }
</script>
<footer style="background-color: #333333; padding: 20px; text-align: center;">
    <p>Equipo alfa buena maravilla onda dinamita escuadrón lobo - Todos los derechos reservados &copy;</p>
    <div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">
    </div>
</footer>
</body>
</html>
