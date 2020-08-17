<?php
    include_once(__DIR__.'/../classes/User.php');
    include_once(__DIR__."/../classes/Transfer.php");
    session_start();

    $name = User::convertIdToName($_GET['id']);
    $response = [
        'status' => 'succes',
        'name' => $name,
    ];

    header('Content-Type: application/json');
    echo json_encode($response); //{'status' : 'succes'};
?>