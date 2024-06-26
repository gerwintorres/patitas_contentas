<?php 
require_once 'funciones_alertas.php';

function registrarCliente($nombre, $apellidos, $tipoDocumento, $numeroDocumento, $telefono, $correo, $password, $direccion) {
    $data = array(
        'id_cliente' => $numeroDocumento,
        'nombres' => $nombre,
        'apellidos' => $apellidos,
        'tipo_documento' => $tipoDocumento,
        'telefono' => $telefono,
        'email' => $correo,
        'clave' => $password,
        'direccion' => $direccion
    );

    $ch = curl_init('http://127.0.0.1:8000/register/client');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        $result = json_decode($response, true);
        $_SESSION['registro'] = true;
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al registrar el usuario');
    }
}
?>