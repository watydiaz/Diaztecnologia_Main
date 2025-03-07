<?php
include '../includes/db.php'; // Asegúrate de incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $clienteId = $_POST['clienteId'];
    $identificacion = $_POST['identificacion'];
    $nombreCliente = $_POST['nombreCliente'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $tipoDispositivo = $_POST['tipoDispositivo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $estadoFisico = $_POST['estadoFisico'];
    $contrasenaPatron = $_POST['contrasenaPatron'];
    $serialImei = $_POST['serialImei'];
    $diagnostico = $_POST['diagnostico'];
    $tecnicoRecibe = $_POST['tecnicoRecibe'];
    $estadoReparacion = $_POST['estadoReparacion'];
    $valorRepuestos = $_POST['valorRepuestos'];
    $valorManoObra = $_POST['valorManoObra'];
    $valorTotalReparacion = $_POST['valorTotalReparacion'];
    $abonoCliente = $_POST['abonoCliente'];
    $fechaHoraRecepcion = date('Y-m-d H:i:s');

    if (empty($clienteId)) {
        // Inserta los datos del cliente en la tabla clientes
        $stmtCliente = $conn->prepare("INSERT INTO clientes (nombre, identificacion, celular, email, direccion) VALUES (?, ?, ?, ?, ?)");
        $stmtCliente->bind_param("sssss", $nombreCliente, $identificacion, $celular, $email, $direccion);
        $stmtCliente->execute();
        $clienteId = $stmtCliente->insert_id;
        $stmtCliente->close();
    } else {
        // Actualiza los datos del cliente existente
        $stmtCliente = $conn->prepare("UPDATE clientes SET nombre = ?, celular = ?, email = ?, direccion = ? WHERE id = ?");
        $stmtCliente->bind_param("ssssi", $nombreCliente, $celular, $email, $direccion, $clienteId);
        $stmtCliente->execute();
        $stmtCliente->close();
    }

    // Insertar datos en la tabla reparaciones
    $stmtReparacion = $conn->prepare("INSERT INTO reparaciones (cliente_id, tipo_dispositivo, marca, modelo, estado_fisico, contrasena_patron, serial_imei, diagnostico, tecnico_recibe, estado_reparacion, valor_repuestos, valor_mano_obra, valor_total_reparacion, abono_cliente, fecha_hora_recepcion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtReparacion->bind_param("isssssssssdidds", $clienteId, $tipoDispositivo, $marca, $modelo, $estadoFisico, $contrasenaPatron, $serialImei, $diagnostico, $tecnicoRecibe, $estadoReparacion, $valorRepuestos, $valorManoObra, $valorTotalReparacion, $abonoCliente, $fechaHoraRecepcion);
    $stmtReparacion->execute();
    $reparacionId = $stmtReparacion->insert_id;
    $stmtReparacion->close();

    // Insertar datos en la tabla facturas
    $stmtFactura = $conn->prepare("INSERT INTO facturas (reparacion_id, fecha, total, metodo_pago) VALUES (?, ?, ?, 'Efectivo')");
    $stmtFactura->bind_param("isd", $reparacionId, $fechaHoraRecepcion, $valorTotalReparacion);
    $stmtFactura->execute();
    $facturaId = $stmtFactura->insert_id;
    $stmtFactura->close();

    // Insertar datos en la tabla detalleFacturas
    $descripcion = "Reparación de $tipoDispositivo $marca $modelo";
    $cantidad = 1;
    $stmtDetalleFactura = $conn->prepare("INSERT INTO detalleFacturas (factura_id, descripcion, cantidad, precio_unitario, total) VALUES (?, ?, ?, ?, ?)");
    $stmtDetalleFactura->bind_param("isidd", $facturaId, $descripcion, $cantidad, $valorTotalReparacion, $valorTotalReparacion);
    $stmtDetalleFactura->execute();
    $stmtDetalleFactura->close();

    // Insertar datos en la tabla ventas
    $stmtVenta = $conn->prepare("INSERT INTO ventas (factura_id, fecha, total) VALUES (?, ?, ?)");
    $stmtVenta->bind_param("isd", $facturaId, $fechaHoraRecepcion, $valorTotalReparacion);
    $stmtVenta->execute();
    $stmtVenta->close();

    // Mostrar alerta de registro completado
    echo "<script>alert('Registro completado');</script>";
    echo "<script>window.location.href = '../views/registroReparaciones.php';</script>";
}
?>
