<?php

include("baglanti.php");

$user_err=$email_err=$pass_err=$again_err="";

if(isset($_POST["submit"]))
{

if(empty($_POST["username"]))
{
  $user_err="Not Null";
}
else if(strlen($_POST["username"])<6)
{
  $user_err="Min 6 character.";
}
else{
  $username=$_POST["username"];
}


if(empty($_POST["email"]))
{
  $email_err="Not Null";
}
else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
{
  $email_err = "Invalid email format";
}
else
{
  $email=$_POST["email"];
}


if(empty($_POST["password"]))
{
  $pass_err="Not Null";
}
else
{
  $password=password_hash($_POST["password"],PASSWORD_DEFAULT);
}


if(empty($_POST["passwordagain"]))
{
  $again_err="Not Null";
}
else if($_POST["password"]!=$_POST["passwordagain"])
{
  $again_err='passwords are not the same';
}
else
{
  $againpassword=$_POST["passwordagain"];
}


  $add="INSERT INTO kullanicilar (kullanici_adi, email, parola) VALUES ('$username', '$email', '$password')";
  $nextadd = mysqli_query($baglanti,$add);

  if($nextadd) 
  {
    echo '<div class="alert alert-primary" role="alert">
    Kayıt Başarılı :)
  </div>';
  }
  else
  {
    echo '<div class="alert alert-danger" role="alert">
    Kayıt Başarısız!!!
  </div>';
  }

  mysqli_close($baglanti);

}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Üye Kayıt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <div class="container p-5">
    <div class="card p-5" >

      <form action="kayit.php" method="POST">
      
      <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">User Name</label>
          <input type="text" class="form-control <?php if(!empty($user_err)){echo "is-invalid";} ?>" id="exampleInputEmail1" name="username">
          <div class="invalid-feedback">
      <?php 
      echo $user_err;
      ?>
    </div>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="text" class="form-control <?php if(!empty($email_err)){echo "is-invalid";} ?>" id="exampleInputEmail1" name="email">
          <div class="invalid-feedback">
      <?php 
      echo $email_err;
      ?>
    </div>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control <?php if(!empty($pass_err)){echo "is-invalid";} ?>" id="exampleInputPassword1" name="password">
          <div class="invalid-feedback">
      <?php 
      echo $pass_err;
      ?>
    </div>

    <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control <?php if(!empty($again_err)){echo "is-invalid";} ?>" id="exampleInputPassword1" name="passwordagain">
          <div class="invalid-feedback">
      <?php 
      echo $again_err;
      ?>
    </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

      </form>

    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>