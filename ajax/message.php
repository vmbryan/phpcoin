<?php
    include_once(__DIR__.'/../classes/User.php');
    include_once(__DIR__."/../classes/Transfer.php");
    session_start();

    $message = Transfer::getTransferMessageByTransferId($_GET['id']);

        $response = [
            'status' => 'succes',
            'body' => $message,
        ];

    header('Content-Type: application/json');
    echo json_encode($response); //{'status' : 'succes'};
?>