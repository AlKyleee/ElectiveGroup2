<?php
  session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" a href="css/style.css">
  <link rel="stylesheet" a href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<?php
include "DBconn.php";
$error = "";
if (isset($_POST['submit'])) {
  $email = $_POST['txtemail'];
  $password = $_POST['txtpassword'];
  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_type'] = $row['user_type'];
    header("Location: home.php");
    
  } else {
    $error = "<p style='color:white;'>Incorrect E-mail/Password</p>";
  }
}
?>

<body>
  <div class="con">
    <img src="https://media.discordapp.net/attachments/791227607899045893/1035598183860027452/login.png">
    <form action="" method="POST">
      <div class="form-input">
        <input type="text" id="txtemail" name="txtemail" placeholder="E-mail" required>
      </div>
      <div class="form-input">
        <input type="password" id="txtpassword" name="txtpassword" placeholder="Password" required>
      </div>
      <br>
      <?php echo $error; ?>
      <input name="submit" type="submit" value="LOGIN" class="btn-login">
    </form>
    <br>
    <a href="register.php">Don't have an account? Register here!</a>
  </div>

</body>

</html>