<?php
include '../includes/db.php';

if (isset($_GET['identificacion'])) {
    $identificacion = $_GET['identificacion'];
    $query = "SELECT * FROM clientes WHERE identificacion LIKE '%$identificacion%'";
    $result = mysqli_query($conn, $query);

    $clientes = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $clientes[] = $row;
        }
    }
    echo json_encode($clientes);
}
?>
