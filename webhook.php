<?php
include ('conexion.php');

$method=$_SERVER['REQUEST_METHOD'];

if ($method =='POST')
{
    $requestBody= file_get_contents('php://input');
    $params= json_decode($requestBody);

    $params=(array) $params;

    if($params['productos'])
    {
        $data=
        [
            'productos' => $params['productos']
        ];

        $sql = "INSERT INTO productos_buscados (productos) VALUES (:productos)";
        $stmt= $conexion->prepare($sql);
        $stmt->execute($data);
        $last_id=$conexion->lastInsertId();
    }

    if($last_id)
    {
        echo 'Tu producto ha sido buscado';
    }

    else{
        echo 'Error al buscar el producto';
    }
}
?>