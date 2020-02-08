<?php
include('connect.php'); //connect to database
session_start();
$message = "";

//check if session exist
if (isset($_SESSION['user_id'])) {
    //check if permission exist in session
    if (isset($_SESSION['permission'])) {
        if ($_SESSION['permission'] === "teacher") {
            header('location: teacher/index.php'); //if user is GiaoVien
        } else if ($_SESSION['permission'] === "student") {
            header('location: student/index.php'); //if user is SinhVien
        } else {
            header('location: index.php');
        }
    }
    exit();
}
if (isset($_POST['login'])) {
    try {
        //checking empty fields
        if (empty($_POST['username'])) {
            throw new Exception("Username is required!");
        }
        if (empty($_POST['password'])) {
            throw new Exception("Password is required!");
        }
        //delete space and special char in form data
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));
        $result = LoginCheck($username, $password); //check if user is login
        if ($result === false) {
            throw new Exception("Username or Password is wrong, try again!"); //error messenge
            header('location: index.php');
        } else {
            if (GVCheck($username, $password) === true) { //check if user is GiaoVien
                $_SESSION['user_id'] = $result['Id']; //save id to session
                $_SESSION['permission'] = "teacher"; //set permission to user and save to session
                header('location: teacher/index.php');
                exit();
            } else {
                $_SESSION['user_id'] = $result['Id']; //save id to session
                $_SESSION['permission'] = "student"; //set permission to user and save to session
                header('location: student/index.php');
                exit();
            }
        }
    } //end of try block
    catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Online Attendance Management System</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="styles.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
<center>

    <header>

        <h1>Online Attendance Management System 1.0</h1>

    </header>

    <h1>Login</h1>

    <?php
    //printing error message
    if (isset($error_msg)) {
        echo $error_msg;
    }
    ?>

    <div class="content">
        <div class="row">

            <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-7">
                        <input type="text" name="username" class="form-control" id="input1"
                               placeholder="your username"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-7">
                        <input type="password" name="password" class="form-control" id="input1"
                               placeholder="your password"/>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Login" name="login"/>
            </form>
        </div>
    </div>


    <br><br>

</center>
</body>
</html>