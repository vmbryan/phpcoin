<?php
include_once("./classes/User.php");
include_once("./classes/Transfer.php");
session_start();
if (!isset($_SESSION['user'])) {
    //ok
    header("Location: index.php");
}
$data = User::getData($_SESSION['user']);
$searchData = Transfer::viewData();

$_SESSION['tokens'] = $data['tokens'];
$_SESSION['name'] = $data['name'];
$_SESSION['id'] = $data['id'];

$transfers = Transfer::getTransfersForCurrentUser($data['id']);

// echo "<pre>"; print_r($transfers); echo "</pre>";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wallet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/wallet.css">
</head>

<body class="bg-light pt-3">

    <main role="main" class="container">
        <div class="d-flex justify-content-between align-items-center  bg-light pt-1">
            <img class="" src="./assets/brand/cent-text-solid.svg" alt="logo" width="150">
            <div>
                <a href="logout.php" class='btn btn-primary' role='button'>Log out</a>
            </div>
        </div>

        <div class="d-flex flex-column align-items-center bg-white rounded shadow-sm pt-1 mt-3">
            <h2 class='font-weight-bold mt-1'>Hello <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
            <p class="font-weight-bold mb-1 text-info">current balance</p>

            <h2 class="pb-1" id="saldo">
                <?php if ($_SESSION['tokens'] < 1) {
                    echo "You have no tokens!";
                } else {
                    echo htmlspecialchars($_SESSION['tokens']);
                }; ?>
                </h3>

        </div>

        <div class="d-flex justify-content-center">
            <a class="btn btn-block btn-primary mt-3" href="#" role="button" onclick='togSend()'>Send tokens</a>
        </div>

        <form class="bg-white my-3 p-3 bg-white rounded shadow-sm " method="post" id="sendmessage">

            <div id='errorblock' class="alert alert-warning" role="alert">

            </div>


            <div id='succesblock' class="alert alert-success" role="alert">

            </div>


            <!-- search bar -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" name="receiver_id" id='receiver_id' placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <ul id='match_list' class='list-group'>
            </ul>
            <!-- end search bar -->

            <div class="input-group mb-3 mt-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tokens</span>
                </div>
                <input type="text" name="amount" id='amount' class="form-control" aria-label="amount">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Message</span>
                </div>
                <input type="text" name="message" id='message' class="form-control" aria-label="Message">
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-block btn-success mt-3" type="button" id='sendTokens' href="#" role="button">Confirm</button>
            </div>
            <div class="d-flex justify-content-center">
                <a class="btn btn-block btn-danger mt-3" href="#" role="button" onclick='togSend()'>Cancel</a>
            </div>
        </form>

        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h3 class="transfers border-bottom border-gray pb-2 mb-3">Recent transfers</h3>

            <ul class="list-unstyled " id="transfers">
                <?php foreach ($transfers as $transfer) : ?>
                    <li class='transfer_item mb-3' data-transferId='<?php echo($transfer["id"]);?>'>
                        <div class='card'>
                            <div class="card-header p-0 pl-2 text-gray-dark lead d-flex justify-content-between">
                                <h6 class='mb-0 my-auto'>
                                    <?php if ($transfer['sender_id'] === $data['id']) {
                                        echo ('You');
                                    } else {
                                        echo (User::convertIdToName($transfer['sender_id']));
                                    } ?>
                                    sent
                                    <?php echo ($transfer['tokens']); ?>
                                    Cents to
                                    <?php if ($transfer['receiver_id'] === $data['id']) {
                                        echo ('You');
                                    } else {
                                        echo (User::convertIdToName($transfer['receiver_id']));
                                    } ?>
                                    </h6>
                                    <p class='mb-0 my-auto width alert alert-<?php echo (Transfer::changeColorBasedOnPlusOrMin($data['id'], $transfer['sender_id'])); ?> d-inline-flex p-1 transfer-data'><?php echo (Transfer::checkIfPlusOrMin($data['id'], $transfer['sender_id'], $transfer['tokens'])); ?> </p>
                            </div>
                            <div class="card-body p-2 d-none justify-content-between mb-0 border-bottom border-gray" id="cardbody<?PHP echo($transfer['id'])?>">
                                <p class="transferMessage mb-0 w-75" id='transferMessage<?php echo($transfer['id'])?>'>Hey thanks for helping me that was very nice of you!</p>
                                <button type="button" class="close" id='close1' aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        Details
                    </li>

                <?php endforeach; ?>
            </ul>


        </div>
    </main>
    <script>
        window.localStorage.setItem('userid', <?php echo json_encode($_SESSION['id']); ?>);
    </script>
    <script src="js/refresh.js"></script>
    <script src="js/wallet.js"></script>
    <script src="js/search.js"></script>
</body>

</html>