<?php
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        require_once '../connection.php';
        $sql ="SELECT * FROM  sutd_detail WHERE email= '$email' "; 
        try
        {
            $conn = new PDO("mysql:host=$hm; dbname=$db", $un, $pw);   
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }
        catch(PDOException $e)
        { 
            echo "Connection failed: " . $e->getMessage(); 
        } 
          $query= $conn -> prepare($sql);
          $query-> execute();
          $result = $query -> fetchAll();
          if($query -> rowCount() > 0)
          { 
            foreach($result as $user)
            {
              if($user['email']==$email and $user['pass']===$pass)
              {
               session_start();
               $_SESSION['id']=$user['id'];
               $_SESSION['name']=$user['name'].' '.$user['lname'];
               $_SESSION['fname']=$user['name'];
               $_SESSION['lname']=$user['lname'];
               $_SESSION['mname']=$user['mname'];
               $_SESSION['eno']=$user['eno'];
               $_SESSION['mono']=$user['mono'];
               $_SESSION['pono']=$user['pmono'];
               $_SESSION['email']=$user['email'];
               $_SESSION['year']=$user['year'];
               header("location:dashboard.php");
              }
              else
              {
                echo "<script>alert('Please enter valid password')</script>";
              }
            }
          }
          else
          {
            echo "<script>alert('Please enter correct Email or password')</script>";
          }
          unset($result);
          $conn=null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <title> ELECTRONIC & TELECOMMUNICATION ENGINEERING</title>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">ELECTRONIC & TELECOMMUNICATION ENGINEERING</span>
      </div>
    </div>
  </nav>
  <br><br>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="card" style="width: 40rem;">
        <div class="card-header">
          <img src="https://getmyuni.azureedge.net/college-images-test/deogiri-institute-of-engineering-and-management-studies-diems-aurangabad/6750521d00e04f49a0f0b34c2a4c3fba.jpeg" class="card-img-top" alt="...">
        </div> 
        <div class="card-body">
          <center>
            <h5 class="card-title text-center">Student Login</h5>
            <hr>
          </center>
          <br>
          <form method='post'>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" name='email'>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" name='pass'>
              </div>
            </div>  
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary" name='login'>Login</button>
            </div>
          </form>
          <br>
            Cookies must be enabled in your browser 
          <br>
          <a href="forgot.php">Forgotten your password?</a><br><br>
          <a href="register.php">Register new student</a>
          <br><br>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ"
    crossorigin="anonymous"></script>
</body>

</html>