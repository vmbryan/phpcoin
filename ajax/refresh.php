<?php
    include_once(__DIR__.'/../classes/User.php');
    include_once(__DIR__."/../classes/Transfer.php");
    session_start();
    $tokens = User::getTokensForUserById($_GET['id']);
    
    $response = [
        'status' => 'succes',
        'body' => $tokens,
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response); //{'status' : 'succes'};
?>