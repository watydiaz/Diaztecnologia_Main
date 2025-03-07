<?php
include '../includes/header.php';
?>

<!-- Contenido de la página de registro de reparaciones -->
<div class="container">
    <h1>Registro de Reparaciones</h1>
    <form id="registroReparacionesForm">
        <input type="hidden" id="clienteId" name="clienteId" value="1">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="fechaHoraRecepcion">Fecha y Hora de Recepción</label>
                <input type="text" class="form-control" id="fechaHoraRecepcion" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="identificacion">Identificación</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Identificación" value="123456789">
            </div>
            <div class="form-group col-md-4">
                <label for="nombreCliente">Nombre Cliente</label>
                <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" placeholder="Nombre Cliente" value="Juan Pérez">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" value="987654321">
            </div>
            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="juan.perez@example.com">
            </div>
            <div class="form-group col-md-4">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="Calle Falsa 123">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="tipoDispositivo">Tipo de Dispositivo</label>
                <input type="text" class="form-control" id="tipoDispositivo" name="tipoDispositivo" placeholder="Tipo de Dispositivo" value="Teléfono">
            </div>
            <div class="form-group col-md-4">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca" value="Samsung">
            </div>
            <div class="form-group col-md-4">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo" value="Galaxy S21">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="estadoFisico">Estado Físico</label>
                <input type="text" class="form-control" id="estadoFisico" name="estadoFisico" placeholder="Estado Físico" value="Bueno">
            </div>
            <div class="form-group col-md-4">
                <label for="contrasenaPatron">Contraseña/Patrón</label>
                <input type="text" class="form-control" id="contrasenaPatron" name="contrasenaPatron" placeholder="Contraseña/Patrón" value="1234">
            </div>  
            <div class="form-group col-md-4">
                <label for="serialImei">Serial/IMEI</label>
                <input type="text" class="form-control" id="serialImei" name="serialImei" placeholder="Serial/IMEI" value="123456789012345">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="diagnostico">Diagnóstico</label>
                <textarea class="form-control" id="diagnostico" name="diagnostico" rows="3" placeholder="Diagnóstico">Pantalla rota</textarea>
            </div>
            <div class="form-group col-md-4">
                <label for="tecnicoRecibe">Técnico que Recibe</label>
                <input type="text" class="form-control" id="tecnicoRecibe" name="tecnicoRecibe" placeholder="Técnico que Recibe" value="Carlos López">
            </div>
            <div class="form-group col-md-4">
                <label for="estadoReparacion">Estado de Reparación</label>
                <input type="text" class="form-control" id="estadoReparacion" name="estadoReparacion" placeholder="Estado de Reparación" value="En proceso">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="valorRepuestos">Valor de Repuestos</label>
                <input type="text" class="form-control" id="valorRepuestos" name="valorRepuestos" placeholder="Valor de Repuestos" value="50">
            </div>
            <div class="form-group col-md-4">
                <label for="valorManoObra">Valor Mano de Obra</label>
                <input type="text" class="form-control" id="valorManoObra" name="valorManoObra" placeholder="Valor Mano de Obra" value="30">
            </div>
            <div class="form-group col-md-4">
                <label for="valorTotalReparacion">Valor Total de la Reparación</label>
                <input type="text" class="form-control" id="valorTotalReparacion" name="valorTotalReparacion" placeholder="Valor Total de la Reparación" value="80">
            </div>
            <div class="form-group col-md-4">
                <label for="abonoCliente">Abono del Cliente</label>
                <input type="text" class="form-control" id="abonoCliente" name="abonoCliente" placeholder="Abono del Cliente" value="40">
            </div>
        </div>
        <center><button type="submit" class="btn btn-dark">Registrar</button></center>
    </form>
</div>
<br><br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registroReparacionesForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '../controllers/procesarReparacion.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert('Registro exitoso: ' + response);
                },
                error: function(xhr, status, error) {
                    alert('Error en el registro: ' + xhr.responseText);
                }
            });
        });
    });
</script>
<?php
include '../includes/footer.php';
?>