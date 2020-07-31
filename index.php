<?php 
    include_once(__DIR__."/classes/User.php");
    session_start();

    if (!empty($_POST)) {
      try {
        //code...
        //$con = Db::getConnection();
        $user = new User();
        $email = $_POST['email'];
        $password = ($_POST['password']);
        $user->verify($email,$password);

      } catch (\Throwable $th) {
        //throw $th;
        $error = $th->getMessage();
      }
    }

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
  <form class="form-signin" method="post" action="">
    <img class="mb-2" src="./assets/brand/cent-text-solid.svg" alt="" width="250" height="100">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <?php if(isset($error)): ?>
        <div class="alert alert-warning" role="alert">
            <?php echo $error;?>
        </div>
    <?php endif ;?>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
    <p>Not a member yet? please sign up <a href="register.php" class="link text-primary">Here!</a></p>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

  </form>
</body>

</html>