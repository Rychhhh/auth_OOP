<?php 

// Ambil fungsi AuthClass

require_once '../config/config.php';

// Cek status login users

if($user->isLoggedIn()) {

    header('location: ../index.php'); // redirect menuju halaman home

}

// jika ada data yang dikirim
if (isset($_POST['submit'])) {

    $email = $_POST['email'];

    $password = $_POST['password'];

    // proses login

    if($user->login($email, $password)) {

        header('location: ../index.php');
        
    } else {

        // Jika login error, maka kirim pesan error
        
        $error = $user->getLastError();

    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/login.css">

    <title>Login </title>
  </head>
  <body>

    <h1 class="title text-center mb-3">Login </h1>


    <form method="POST" class="form text-center">

    <!-- Jika login error -->
    
    <?php if(isset($error)) : ?>

        <div class="badge bg-danger" on>

            <?php echo $error ?>

        </div>

        <?php endif; ?>

        <div class="mb-3">
            <label  class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Email tidak akan pernah kita share kepada orang lain</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" id="btn-submit" name="submit" class="btn btn-success mt-3">Submit</button>
        <a class="btn btn-info mt-3" href="register.php">Create an account</a>
    </form>

    <!-- Bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const btn = document.getElementById('btn-submit');

        btn.addEventListener('click', function() {
            Swal.fire(
            'Success Login!',
            )
        })

    </script>
  </body>
</html>


   