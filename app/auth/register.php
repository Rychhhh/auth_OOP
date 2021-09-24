<?php 


// Require menuju config 

require_once '../config/config.php';


// cek status login

if($user->isLoggedIn()) {

    header('location: ../index.php'); // redirect index

}


// jika ada data yang dikirimkan

if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];

    $email = $_POST['email'];

    $password = $_POST['password'];


    if($user->register($nama, $email, $password)) {

        $success = true;

    } else {

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Register</title>
    <link rel="stylesheet" href="../css/register.css">
  </head>
  <body>
    <h1 class="title text-center mb-3">Register</h1>

    <form method="POST" class="form text-center">

    <?php if(isset($error)) : ?>

      <div class="badge bg-danger" on>

          <?php echo $error ?>

      </div>

    <?php endif; ?>

        <?php if (isset($success)): ?> 

        <div class="success" style="padding-left:1px;"> 

          Berhasil mendaftar. Silakan 
          <br>
          <a class="btn btn-success mt-2 mb-2" href="login.php">login</a> 

        </div> 

        <?php endif; ?>
        

      <div class="mb-3">

        <label for="username" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control">

      </div>

      <div class="mb-3">

      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control">
      <div class="form-text">Kita tidak share email anda</div>

        </div>

      <div class="mb-4">
        
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" >
      </div>
      <button type="submit" id="btn-register" name="submit" class="btn btn-primary" >Submit</button>
      <a class="btn btn-info" href="login.php">A have an account</a>
</form>

    <!-- Bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
      const btn_register = document.getElementById('btn-register');
      btn_register.addEventListener('click', function() {
        Swal.fire('Congratulation!')
      })
    </script>
  </body>
</html>