<?php
//Edit student profile with
include('../connect.php');
ob_start();
session_start();

//check if session is not valid
if (!isset($_SESSION['user_id'])) {
    header('location: ../login.php');
}
else{
    $result = "";
    if (isset($_POST['search'])) {
        try {
            //check form data and empty field
            if (empty($_POST['id'])) {
                throw new Exception("Id không được để trống");
            }
            //delete space and special char in form data
            $id = trim(htmlspecialchars($_POST['id']));
            $result = GetSVById($id); //get SinhVien from SinhVien table with ID
            if ($result === false) {
                throw new Exception("This ID is not exist, try again!"); //error messenge
                header('location: editProfileStudent.php');
            } else {
                $_SESSION['IdStd_edit']=$id; //save Id of student who need to edit profile to session
                header('location:editProfileStudentForm.php'); //redirect to form edit
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
    ?>
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
            <h3>Find student to edit with ID</h3>
            <br>
            <!-- Error or Success Message printint started --><p>
                <?php
                if(isset($error_msg))
                {
                    echo $error_msg;
                }
                ?>
            </p><!-- Error or Success Message printint ended -->
            <form method="post" action="">
                <label>Student ID</label>
                <input type="text" name="id">
                <input type="submit" name="search" value="Go!">
                <?php
                //printing error message
                if (isset($error_msg)) {
                    echo "<br>".$error_msg;
                }
                ?>
            </form>
            <br>
        </div>

</center>

</body>
</html>