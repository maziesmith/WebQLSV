<?php
//form data to edit profile of student
include('../connect.php');
ob_start();
session_start();

//check if session is not valid
if (!isset($_SESSION['user_id'])) {
    header('location: ../login.php');
} else {
    $IdStudent = $_SESSION['IdStd_edit']; //get Id of student who need to edit profile from session
    $result = GetSVById($IdStudent); //get SinhVien from SinhVien table with ID
    $default_username = "";
    $default_password = "";
    $default_name = "";
    $default_email = "";
    $default_sdt = "";
    $default_gpa = "";
    //set value for default values if had user
    if ($result !== false) {
        $default_username = htmlspecialchars($result['Username']);
        $default_password = htmlspecialchars($result['Password']);
        $default_name = htmlspecialchars($result['HoTen']);
        $default_email = htmlspecialchars($result['Email']);
        $default_sdt = htmlspecialchars($result['SĐT']);
        $default_gpa = htmlspecialchars($result['GPA']);
    }
    if (isset($_POST['submit'])) {
        try {
            //check form data and empty field
            if (empty($_POST['username'])) {
                throw new Exception("Username không được để trống");
            }
            if (empty($_POST['password'])) {
                throw new Exception("Password không được để trống");
            }
            if (empty($_POST['name'])) {
                throw new Exception("Họ tên không được để trống");
            }
            if (empty($_POST['email'])) {
                throw new Exception("Email không được để trống");
            }
            if (empty($_POST['sdt'])) {
                throw new Exception("Số điện thoại không được để trống");
            }
            if (empty($_POST['gpa'])) {
                throw new Exception("GPA không được để trống");
            }
            //delete space and special char in form data
            $username = trim(htmlspecialchars($_POST['username']));
            $password = trim(htmlspecialchars($_POST['password']));
            $name = trim(htmlspecialchars($_POST['name']));
            $email = trim(htmlspecialchars($_POST['email']));
            $sdt = trim(htmlspecialchars($_POST['sdt']));
            $GPA = trim(htmlspecialchars($_POST['gpa']));
            $edit = EditInfoSinhVien($IdStudent, $name, $email, $sdt, $username, $password, $GPA); //edit profile of student in User table and SinhVien table
            if ($edit === false) {
                throw new Exception("Something wrong, try again!"); //error messenge
                header('location: editProfileStudentForm.php');
            } else {
                $success_msg = 'Updated  successfully'; //success messenge
                header('location: students.php'); //redirect to student list
                exit();
            }
        } catch (Exception $e) {
            $error_msg = $e->getMessage();
        }
    }
}
?>

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
            <h3>Edit Profile</h3>
            <br>
            <!-- Error or Success Message printint started --><p>
                <?php
                if (isset($success_msg)) {
                    echo $success_msg;
                }
                if (isset($error_msg)) {
                    echo $error_msg;
                }
                ?>
            </p><!-- Error or Success Message printint ended -->
            <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-7">
                        <input type="text" name="username" class="form-control" id="input1" placeholder="Username"
                               value="<?= $default_username ?>">
                        <!--set php string variable contain space for value attribute-->
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-7">
                        <input type="password" name="password" class="form-control" id="input1" placeholder="Password"
                               value="<?= $default_password ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Họ Tên</label>
                    <div class="col-sm-7">
                        <input type="text" name="name" class="form-control" id="input1" placeholder="Họ Tên"
                               value="<?= $default_name ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-7">
                        <input type="text" name="email" class="form-control" id="input1" placeholder="Email"
                               value="<?= $default_email ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Số Điện Thoại</label>
                    <div class="col-sm-7">
                        <input type="text" name="sdt" class="form-control" id="input1" placeholder="Số Điện Thoại"
                               value="<?= $default_sdt ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">GPA</label>
                    <div class="col-sm-7">
                        <input type="text" name="gpa" class="form-control" id="input1" placeholder="GPA"
                               value="<?= $default_gpa ?>">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Submit" name="submit"/>

            </form>
        </div>
    </div>

</center>

</body>
</html>