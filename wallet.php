<?php
include_once("./classes/User.php");
session_start();
if (!isset($_SESSION['user'])) {
    //ok
    header("Location: index.php");
}

$tokens = User::getTokens($_SESSION['user']);

try {
    //code...


} catch (\Throwable $th) {
    //throw $th;
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wallet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/wallet.css">
    <link rel="stylesheet" href="./css/colors.css">
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
            <h2 class='font-weight-bold mt-1'>Hello name!</h2>
            <p class="font-weight-bold mb-1 text-info">current balance</p>

            <h2 class="pb-1">
                <?php if ($tokens < 1) {
                    echo "You have no tokens!";
                }
                echo $tokens; ?>
            </h3>

        </div>

        <div class="d-flex justify-content-center">
            <a class="btn btn-block btn-primary mt-3" href="#" role="button" onclick='togSend()'>Send tokens</a>
        </div>

        <form class="bg-white my-3 p-3 bg-white rounded shadow-sm " id="sendmessage" action="">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tokens</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Message</span>
                </div>
                <textarea class="form-control" aria-label="Message"></textarea>
            </div>
            <div class="d-flex justify-content-center">
                <a class="btn btn-block btn-success mt-3" href="#" role="button">Confirm</a>
            </div>
            <div class="d-flex justify-content-center">
                <a class="btn btn-block btn-danger mt-3" href="#" role="button" onclick='togSend()'>Cancel</a>
            </div>
        </form>

        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h3 class="border-bottom border-gray pb-2 mb-0">Recent transfers</h3>
            <div class="media text-muted pt-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                </svg>
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">@username</strong>
                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                    condimentum nibh, ut fermentum massa justo sit amet risus.
                </p>
            </div>

            <div class="media text-muted pt-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#e83e8c" /><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text>
                </svg>
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">@username</strong>
                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                    condimentum nibh, ut fermentum massa justo sit amet risus.
                </p>
            </div>

            <div class="media text-muted pt-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#6f42c1" /><text x="50%" y="50%" fill="#6f42c1" dy=".3em">32x32</text>
                </svg>
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">@username</strong>
                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                    condimentum nibh, ut fermentum massa justo sit amet risus.
                </p>
            </div>


        </div>
    </main>
    <script src="js/wallet.js"></script>
</body>

</html>