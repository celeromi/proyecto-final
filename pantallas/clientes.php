<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="assets/estilomodal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
        /* Estilos para el ícono de advertencia */
        .modal-content .icon {
            font-size: 40px;
            color: #28a745; /* Amarillo para la advertencia */
            margin-bottom: 15px;
        }
        /* Título del modal */
        .modal-content h2 {
            font-size: 24px;
            margin: 0;
            color: black;
        }
        /* Mensaje de advertencia */
        .modal-content p {
            font-size: 16px;
            color: #333333;
            margin: 10px 0 20px;
        }
        /* Botones de acción */
        .modal-content .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .modal-content .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .modal-content .confirm-btn {
            background-color: #607d8b;
            color: white;
        }
        .modal-content .cancel-btn {
            background-color: #D32F2F;
            color: white;
        }
        .download-btn {
            background-color: #28a745;
            border: none;
            color: white;
            border-radius: 4px;
        }
        /* Botón de cierre */
        .close-btn {
            background-color: #dc3545;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }
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
    <h1>Clientes</h1>
    <div class="search-bar">
        <!-- Buscador de Clientes -->
        <input type="text" id="search" placeholder="Buscar cliente...">
        <button onclick="searchProduct()">🔍</button>
        <!-- Botón para agregar producto -->
        <button onclick="openAddmModal()">Agregar cliente</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Datos de ejemplo
                $clientes = [
                    ["id" => 439, "nombre" => "Josefina", "apellido" => "Gómez", "direccion" => "jazmin 1020", "telefono" => "551-5678"],
                    ["id" => 440, "nombre" => "Juan Pablo", "apellido" => "López", "direccion" => "lapiz 90", "telefono" => "555-9876"],
                    ["id" => 441, "nombre" => "Ana", "apellido" => "Rodríguez", "direccion" => "uva 123", "telefono" => "555-4321"],
                    ["id" => 442, "nombre" => "Pedro", "apellido" => "Sánchez", "direccion" => "naranja 2510", "telefono" => "555-8765"],
                    ["id" => 443, "nombre" => "Laura", "apellido" => "Torres", "direccion" => "tres 653", "telefono" => "555-3210"],
                    ["id" => 444, "nombre" => "Miguel", "apellido" => "Hernández", "direccion" => "hoja 511", "telefono" => "555-6543"],
                    ["id" => 445, "nombre" => "Sofía", "apellido" => "Díaz", "direccion" => "pelota 567", "telefono" => "555-2109"],
                    ["id" => 446, "nombre" => "Alejandro", "apellido" => "Martínez", "direccion" => "timtim 345", "telefono" => "345-60282"],
                    ["id" => 447, "nombre" => "Carmen", "apellido" => "García", "direccion" => "pimpon 45", "telefono" => "555-8775"],
                    ["id" => 448, "nombre" => "David", "apellido" => "Ruiz", "direccion" => "fulano 123", "telefono" => "555-9921"]
                ];
                
                // Generar filas de la tabla
                foreach ($clientes as $cliente) {
                    echo "<tr>";
                    echo "<td>{$cliente['id']}</td>";
                    echo "<td>{$cliente['nombre']}</td>";
                    echo "<td>{$cliente['apellido']}</td>";
                    echo "<td>{$cliente['direccion']}</td>";
                    echo "<td>{$cliente['telefono']}</td>";
                    echo "<td>";
                    // Botónes para eliminar, editar, mostrar el historial y presupuesto del cliente
                    echo "<button class='action-btn edit-btn' onclick='openEditModal()'>✏️</button>";
                    echo "<button class='action-btn info-btn' onclick='openHistoryModal()'>📄</button>";
                    echo "<button class='action-btn activ-btn' onclick='ocultarProducto(this)'>🗑️</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Agregar Cliente Nuevo</h2>
        
        <!-- Formulario con labels -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" value="">
            </div>
        
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" value="">
        </div>
        
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" id="direccion" value="">
        </div>

        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" id="telefono" value="">
        </div>

        <div class="buttons">
            <button class="save-btn" onclick="saveChanges()">Guardar</button>
            <button class="cancel-btn" onclick="closeAddmModal()">Cancelar</button>
        </div>
    </div>
</div>
<!-- Modal de Historial -->
<div id="historyModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">Historial de Compras y Presupuestos</div>
        
        <!-- Tabla de historial -->
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ejemplo de una fila de compra/presupuesto -->
                <tr>
                    <td>2024-11-14</td>
                    <td>$150.00</td>
                    <td>Pagado</td>
                    <td>
                        <button class="action-btn download-btn" onclick="downloadReceipt('2024-11-14')">Descargar</button>
                    </td>
                </tr>
                <tr>
                    <td>2024-10-20</td>
                    <td>$75.00</td>
                    <td>Pendiente</td>
                    <td>
                        <button class="action-btn download-btn" onclick="downloadReceipt('2024-10-20')">Descargar</button>
                    </td>
                </tr>
                <!-- Más filas se pueden agregar aquí -->
            </tbody>
        </table>

        <button class="close-btn" onclick="closeHistoryModal()">Cerrar</button>
    </div>
</div>

<!-- Modal de edición -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h2>Editar Cliente</h2>
        
        <!-- Formulario con labels -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" value="">
        </div>
        
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" value="">
        </div>
        
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" id="direccion" value="">
        </div>

        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" id="telefono" value="">
        </div>

        <div class="buttons">
            <button class="save-btn" onclick="openModal()">Guardar</button>
            <button class="cancel-btn" onclick="closeEditModal()">Cancelar</button>
        </div>
    </div>
</div>

<!-- Modal de Confirmación -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <i class="fas fa-check-circle confirmation-icon" style="font-size: 40px; color: #28a745; margin-bottom: 15px;"></i> <!-- Ícono de advertencia -->
        <h2>Datos guardados correctamente.</h2>
        <p></p>
        <div class="buttons">
            <button class="confirm-btn" onclick="saveChanges()">Aceptar</button>

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
    
    // Funciones para manejar el modal de añadir cliente
    function openAddmModal() {
        document.getElementById("addModal").style.display = "flex";
    }

    function closeAddmModal() {
        document.getElementById("addModal").style.display = "none";
    }

    function saveChanges() {
        alert("Cliente guardados.");
        closeAddmModal();
    }
    // Función para abrir el modal de historial
        function openHistoryModal() {
        document.getElementById("historyModal").style.display = "flex";
    }

        // Función para cerrar el modal
    function closeHistoryModal() {
        document.getElementById("historyModal").style.display = "none";
    }

        // Función para descargar el recibo/comprobante
    function downloadReceipt(date) {
        alert("Descargando el recibo de la compra/presupuesto del " + date);
        // Aquí podrías hacer una llamada a tu servidor para descargar el comprobante
    }

    // Funciones para manejar el modal de editar cliente
    function openEditModal() {
        document.getElementById("editModal").style.display = "flex";
    }

    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }

    // Función para abrir el modal de confirmación
    function openModal() {
        document.getElementById("confirmationModal").style.display = "flex";
    }

    // Función para cerrar el modal de confirmación
    function closeModal() {
        document.getElementById("confirmationModal").style.display = "none";
    }

    // Función para guardar los cambios
    function saveChanges() {
        closeModal(); // Cierra el modal de confirmación
        closeEditModal(); // Cierra el modal de edición
    }
</script>
<footer style="background-color: #333333; padding: 20px; text-align: center;">
    <p>Equipo alfa buena maravilla onda dinamita escuadrón lobo - Todos los derechos reservados &copy;</p>
    <div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">
    </div>
</footer>
</body>
</html>
    