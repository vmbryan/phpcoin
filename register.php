<?php
    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/Db.php");

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sign in</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="./css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <form class="form-signin">
    <img class="mb-2" src="./assets/brand/cent-text-solid.svg" alt="" width="250" height="100">
    <h1 class="h3 mb-3 font-weight-normal">Register here</h1>
    <label for="inputName" class="sr-only">Name</label>
    <input type="email" id="inputName" class="form-control" placeholder="Name" required autofocus>
    <label for="inputLastName" class="sr-only">LastName</label>
    <input type="email" id="inputLastName" class="form-control" placeholder="Last name" required autofocus>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

  </form>
</body>

</html>