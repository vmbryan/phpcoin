<?php
    include_once(__DIR__.'/../classes/User.php');
    include_once(__DIR__."/../classes/Transfer.php");
    session_start();
    if(!empty($_POST)){
        // new transfer

            $transfer = new Transfer();
            $data = User::getData($_SESSION['user']);
            // zet de id van de verzender gelijk aan de ID van de huidig ingelogde persoon
            $transfer->setSender($_SESSION['id']);
            $transfer->setReceiver($_POST['receiver_id']);
            $transfer->setAmount($_POST['amount']);
            $transfer->setMessage($_POST['message']);
    
            // opslaan
            $transfer->sendTokens();
    
            // succes!
            $response = [
                'status' => 'succes',
                'body' => htmlspecialchars($transfer->getMessage()),
                'message' => 'comment saved'
            ];
    
            header('Content-Type: application/json');
            echo json_encode($response); //{'status' : 'succes'};
    }
?>