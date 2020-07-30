<?php
    include_once(__DIR__."/classes/User.php");
    $emailRequirement = "@student.thomasmore.be";
	$accountExists = true;
	$emailOk = true;

    if(!empty ($_POST)){
        try {
            //code...
            $con = Db::getConnection();
            $user = new User();
            $user->setName($_POST['name']);
            $user->setLastName($_POST['lastName']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
    
            if(strpos($_POST["email"], $emailRequirement) == false){
                throw new Exception("Student email required i.e. John@student.thomasmore.be");
                $emailOk = false;
            }
            $accountExists = $user->userExists();
            if($accountExists == false && $emailOk == true){
                $user->saveUser();
                $success = "Account succesfully created";
            }
    
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
  <form class="form-signin" method="post">
    <img class="mb-2" src="./assets/brand/cent-text-solid.svg" alt="" width="250" height="100">
    <h1 class="h3 mb-3 font-weight-normal">Register here</h1>

    <?php if(isset($error)): ?>
        <div class="alert alert-warning" role="alert">
            <?php echo $error;?>
        </div>
    <?php endif ;?>
    
    <?php if(isset($success)):?>
        <div class="alert alert-success" role="alert">
            <p><?php echo $success;?></p>
        </div>
	<?php endif;?>
    <label for="name" class="sr-only">Name</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required autofocus>
    <label for="lastName" class="sr-only">LastName</label>
    <input type="text" id="lastName" name ="lastName" class="form-control" placeholder="Last name" required autofocus>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

  </form>
</body>

</html>