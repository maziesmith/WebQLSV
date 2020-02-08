<?php

ob_start();
session_start();

//check if session is not valid
if (!isset($_SESSION['user_id'])) {
    header('location: ../login.php');
}
?>
<?php include('../connect.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Attendance Management System 1.0</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="styles.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

</head>
<body>

<header>

    <h1>Online Attendance Management System 1.0</h1>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="students.php">Students</a>
        <a href="teachers.php">Faculties</a>
        <a href="attendance.php">Attendance</a>
        <a href="editProfile.php">Edit Profile</a>
        <a href="editProfileStudent.php">Edit Profile Student</a>
        <a href="../logout.php">Logout</a>

    </div>

</header>

<center>

    <div class="row">

        <div class="content">
            <h3>Teacher List</h3>

            <table class="table table=stripped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Họ Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số Điện Thoại</th>
                    <th scope="col">Khoa</th>
                    <th scope="col">Năm Kinh Nghiệm</th>
                </tr>
                </thead>

                <?php
                $result = GetAllGV(); //get all GiaoVien in GiaoVien table
                foreach ($result as $key => $value) {
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $value['Id']; ?></td>
                        <td><?php echo $value['HoTen']; ?></td>
                        <td><?php echo $value['Email']; ?></td>
                        <td><?php echo $value['SĐT']; ?></td>
                        <td><?php echo $value['Khoa']; ?></td>
                        <td><?php echo $value['NamKinhNghiem']; ?></td>
                    </tr>
                    </tbody>

                <?php } ?>

            </table>

        </div>

    </div>

</center>

</body>
</html></head>