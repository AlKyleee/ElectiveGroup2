<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
  header("Location: logout.php");
}
include "DBconn.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <a href="home.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
    <div class="container">
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
    <a href="addAdmin.php">Add Admin Account</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Email</th>
                <th>Password</th>
                <th>User Type</th>
            </tr>
            </thead>
            <tbody id="myTable">
            <?php
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $user_id = $row['user_id'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $contact_number = $row['contactNum'];
                $address = $row['address'];
                $email = $row['email'];
                $password = $row['password'];
                $usertype = $row['user_type'];
                echo "<tr>
                        <td>$user_id</td>
                        <td>$first_name</td>
                        <td>$last_name</td>
                        <td>$contact_number</td>
                        <td>$address</td>
                        <td>$email</td>
                        <td>$password</td>
                        <td>$usertype</td>
                        <td><a href='editUser.php?userId=$user_id' value='$user_id' class='btn btn-primary'>Edit</a></td>
                        <td><a href='deleteUser.php?userId=$user_id' value='$user_id' class='btn btn-danger'>Delete</button></td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
    </body>
</html>