<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <!-- <link rel="stylesheet" a href="css/style.css"> -->
  <!-- <link rel="stylesheet" a href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/output.css">
</head>

<?php
include "Database.php";
$error = "";
if (isset($_POST['submit'])) {
    $db = new Database();
    $email = $_POST['txtemail'];
    $password = $_POST['txtpassword'];
    $sql = $db->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    $db->resultSet();
    if ($db->rowCount() == 1) {
        $row = $db->single();
        $_SESSION['email'] = $row->email;
        $_SESSION['user_id'] = $row->user_id;
        $_SESSION['user_type'] = $row->user_type;
        header("Location: home.php");
    } else {
    $error = "<p style='color:white;'>Incorrect E-mail/Password</p>";
    }
}
?>

<body class="flex justify-center items-center w-screen h-screen overflow-hidden bg-center bg-no-repeat bg-cover" style="background-image: url('./images/bg.png')">
  <div class="con bg-white bg-opacity-50 backdrop-blur-lg shadow-md rounded-md p-8 relative flex flex-col pt-16">
    <img src="https://media.discordapp.net/attachments/791227607899045893/1035598183860027452/login.png" class="absolute top-[-35%] left-[50%] translate-x-[-50%]">
    <form action="" method="POST" class="flex flex-col justify-start items-stretch">
      <h1 class="font-bold text-center text-[2rem] mb-6">Login</h1>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input type="text" id="txtemail" name="txtemail" placeholder="E-mail" class="rounded-lg px-4 py-2 place bg-gray-200" required>
      </div>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input type="password" id="txtpassword" name="txtpassword" placeholder="Password" class="rounded-lg px-4 py-2 place bg-gray-200" required>
      </div>
      <br>
      <?php echo $error; ?>
      <input name="submit" type="submit" value="LOGIN" class="btn-login w-full p-2 bg-[#F4B626] rounded-full font-bold text-black cursor-pointer hover:bg-[#f1c458]">
    </form>
    <br>
    <span>
      Don't have an account?
      <a href="register.php" class="text-blue-700 hover:text-blue-600"> Register here!</a>
    </span>
  </div>

</body>

</html>