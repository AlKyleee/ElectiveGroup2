<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
    header("Location: logout.php");
}
require_once("Database.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/output.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav class="flex justify-between items-center p-4 w-full text-white">
        <div class="object-scale-down w-12">
            <img src="./images/login.png" alt="logo">
        </div>
        <div class="flex space-x-2">
            <a href="home.php" class="p-2 text-white font-bold bg-[#F4B626] hover:bg-[#F1C458] rounded-md">Home</a>
            <a href="dashboard.php" class="p-2 text-white font-bold bg-blue-500 hover:bg-blue-400 rounded-md">Dashboard</a>
            <a href="logout.php" class="p-2 text-white font-bold bg-red-500 hover:bg-red-400 rounded-md">Logout</a>
        </div>
    </nav>
    <main class="w-full flex justify-center items-center">
        <div class="rounded-md p-4 bg-white bg-opacity-50 backdrop-blur-sm flex flex-col space-y-4">
            <input class="form-control w-full p-2 rounded-md" id="myInput" type="text" placeholder="Search...">
            <a href="addAdmin.php" class="p-2 w-fit self-end rounded-md bg-blue-500 text-white font-bold hover:bg-blue-400">Add Admin Account</a>
            <div class="max-h-[40vh] min-h-[40vh] block overflow-auto">
                <table class="bg-white bg-opacity-80 rounded-md w-full h-full sticky top-0">
                    <thead class="bg-gray-200 overflow-hidden rounded-t-md sticky top-0">
                        <tr>
                            <th class="p-2 px-4 text-center">User ID</th>
                            <th class="p-2 px-4 text-center">First Name</th>
                            <th class="p-2 px-4 text-center">Last Name</th>
                            <th class="p-2 px-4 text-center">Contact Number</th>
                            <th class="p-2 px-4 text-center">Address</th>
                            <th class="p-2 px-4 text-center">Email</th>
                            <th class="p-2 px-4 text-center">Password</th>
                            <th class="p-2 px-4 text-center">User Type</th>
                            <th class="p-2 px-4 text-center"></th>
                            <th class="p-2 px-4 text-center"></th>
                        </tr>
                    </thead>
                    <tbody id="myTable" class="divide-gray-400 divide-y">
                        <?php
                        $db = new Database();
                        $db->query("SELECT * FROM users");
                        $data = $db->resultSet();
                        foreach($data as $row){
                            $user_id = $row->user_id;
                            $first_name = $row->first_name;
                            $last_name = $row->last_name;
                            $contact_number = $row->contactNum;
                            $address = $row->address;
                            $email = $row->email;
                            $password = $row->password;
                            $usertype = $row->user_type;
                        ?>
                            <tr>
                                <td class="p-2 px-4 text-center"><?php echo $user_id ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $first_name ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $last_name ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $contact_number ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $address ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $email ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $password ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $usertype ?></td>
                                <td class="p-2 px-4 text-center"><a href='editUser.php?userId=<?php echo $user_id ?>' value='<?php echo $user_id ?>' class='text-gray-400'><i class="fa-solid fa-gear hover:scale-110 hover:shadow-md"></i></a></td>
                                <td class="p-2 px-4 text-center"><a href='deleteUser.php?userId=<?php echo $user_id ?>' value='<?php echo $user_id ?>' class='text-red-500'><i class="fa-solid fa-trash hover:scale-110 hover:shadow-md"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
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