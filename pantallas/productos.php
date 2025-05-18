<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="assets/estilomodal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
.fila-oculta {
    opacity: 0.5; /* Hace la fila más opaca */
}

.fila-oculta td {
    pointer-events: none; /* Deshabilita la interacción en las celdas */
}

/* Excepción para el botón de ocultar */
.fila-oculta td:last-child button {
    pointer-events: auto; /* Habilita el botón de "ocultar" */
}

</style>
<body>
<div class="container">
    <h1>Productos</h1>
    <div class="search-bar">
        <!-- Buscador de productos -->
        <input type="text" id="search" placeholder="Buscar producto...">
        <button onclick="searchProduct()">🔍</button>
        <!-- Botón para agregar producto -->
        <button onclick="addProduct()">Agregar Producto</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>ID</th>
                <th>Stock</th>
                <th>Valor Unidad</th>
                <th>Valor Mayorista</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // productos ficticios 
            $productos = [
                ["id" => 539, "nombre" => "Tintura n 01", "stock" => "10", "precio_unitario" => "$1020", "precio_mayorista" => "5678"],
                ["id" => 540, "nombre" => "Peine", "stock" => "10", "precio_unitario" => "$900", "precio_mayorista" => "9876"],
                ["id" => 541, "nombre" => "Fijador", "stock" => "10", "precio_unitario" => "$1230", "precio_mayorista" => "4321"],
                ["id" => 542, "nombre" => "Gel para cabello", "stock" => "10", "precio_unitario" => "$2510", "precio_mayorista" => "8765"],
                ["id" => 543, "nombre" => "Clips x10", "stock" => "10", "precio_unitario" => "$653", "precio_mayorista" => "3210"],
                ["id" => 544, "nombre" => "Broche", "stock" => "10", "precio_unitario" => "$511", "precio_mayorista" => "6543"],
                ["id" => 545, "nombre" => "Acondicionador", "stock" => "10", "precio_unitario" => "$3670", "precio_mayorista" => "2109"],
                ["id" => 546, "nombre" => "Shampoo", "stock" => "10", "precio_unitario" => "$3450", "precio_mayorista" => "345-60282"],
                ["id" => 547, "nombre" => "Tratamiento capillar", "stock" => "10", "precio_unitario" => "$4500", "precio_mayorista" => "8775"],
                ["id" => 548, "nombre" => "Brocha n03", "stock" => "10", "precio_unitario" => "1230", "precio_mayorista" => "9921"]
            ];

            // Mostrar cada producto en una nueva fila de la tabla
            if (count($productos) > 0) {
                foreach ($productos as $producto) {
                    echo "<tr>";
                    echo "<td>" . $producto["nombre"] . "</td>";
                    echo "<td>" . $producto["id"] . "</td>";
                    echo "<td>" . $producto["stock"] . "</td>";
                    echo "<td>" . $producto["precio_unitario"] . "</td>";
                    echo "<td>" . $producto["precio_mayorista"] . "</td>";
                    echo "<td>Disponible</td>";
                    echo "<td>";
                    echo "<button class='action-btn edit-btn' onclick='openEditModal()'>✏️</button>";
                    echo "<button class='action-btn activ-btn' onclick='ocultarProducto(this)'>👁️</button>";
                    
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay productos disponibles</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal de edición -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h2>Editar Producto</h2>
        
        <!-- Formulario con labels -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" value="">
        </div>
            
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" id="stock" value="">
        </div>
        
        <div class="form-group">
            <label for="precio_unitario">Valor Unitario</label>
            <input type="text" id="precio_unitario" value="">
        </div>

        <div class="form-group">
            <label for="precio_mayorista">Valor Mayorista</label>
            <input type="text" id="precio_mayorista" value="">
        </div>

        <div class="buttons">
            <button class="save-btn" onclick="saveChanges()">Guardar</button>
            <button class="cancel-btn" onclick="closeEditModal()">Cancelar</button>
        </div>
    </div>
</div>

<script>
    function ocultarProducto(button) {
    // Encuentra la fila donde está el botón que se presionó
    const fila = button.closest('tr'); // Busca el elemento padre <tr>
    if (fila) {
        fila.classList.add('fila-oculta'); // Agrega la clase para hacerla opaca y deshabilitar interacción
    }
    }
    function ocultarProducto(button) {
    const fila = button.closest('tr');
    if (fila) {
        fila.classList.toggle('fila-oculta'); // Alterna entre ocultar y mostrar
    }
    }


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
    // Función de búsqueda de productos
    function searchProduct() {
        const input = document.getElementById("search").value.toUpperCase();
        const table = document.querySelector("tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let found = false;
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerHTML.toUpperCase().indexOf(input) > -1) {
                    found = true;
                    break;
                }
            }
            rows[i].style.display = found ? "" : "none";
        }
    }

</script>
<footer style="background-color: #333333; padding: 20px; text-align: center;">
    <p>Equipo alfa buena maravilla onda dinamita escuadrón lobo - Todos los derechos reservados &copy;</p>
    <div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">
    </div>
</footer>
</body>
</html>
