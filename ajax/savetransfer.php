<?php
    include_once(__DIR__.'/../classes/User.php');
    include_once(__DIR__."/../classes/Transfer.php");
    session_start();
    if(!empty($_POST)){
        // new transfer
        try {
            //code...
            $transfer = new Transfer();
            $data = User::getData($_SESSION['user']);
            $id = $data['id'];
            $transfer->setSender($id);
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
        } catch (\Throwable $th) {
            //throw $th;
            $error = $th->getMessage();
        }

    }
?>