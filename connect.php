<?php

$connect = new PDO("mysql:host=localhost:3306;dbname=qlsv", "root", "toor"); //connect to qlsv at localhost:3306 with user root
function LoginCheck($username, $password) //check if user is login
{
    global $connect;
    $query = "SELECT * FROM User WHERE Username = :username AND Password = :password";
    try {
        $statement = $connect->prepare($query);
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            $result = $statement->fetch();
            return $result;
        } else return false;
    } catch (PDOException $e) {
    }
}

function CheckUserByID($id) //check if user exist in database
{
    global $connect;
    $query = "SELECT Id FROM User WHERE Id = :id";
    try {
        $statement = $connect->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        $count = $statement->rowCount();
        $result = $statement->fetch();
        if ($count > 0) {
            return true;
        } else return false;
    } catch (PDOException $e) {
    }
}

function GVCheck($username, $password) //check if user is GiaoVien
{
    global $connect;
    $query = "SELECT IdGiaoVien FROM GiaoVien WHERE IdGiaoVien = (SELECT id FROM User WHERE Username = :username AND Password = :password)";
    try {
        $statement = $connect->prepare($query);
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);
        $statement->execute();
        $count = $statement->rowCount();
        $result = $statement->fetch();
        if ($count > 0) {
            return true;
        } else return false;
    } catch (PDOException $e) {
    }
}

function GVCheckById($id) //check if user is GiaoVien with Id
{
    global $connect;
    $query = "SELECT IdGiaoVien FROM GiaoVien WHERE IdGiaoVien = :id";
    try {
        $statement = $connect->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        $count = $statement->rowCount();
        $result = $statement->fetch();
        if ($count > 0) {
            return true;
        } else return false;
    } catch (PDOException $e) {
    }
}

function UpdateInfo($id, $name, $email, $sdt, $password) //update info of profile (use for user who is SinhVien)
{
    global $connect;
    $query = "UPDATE User SET HoTen=:name,Email=:email, SĐT=:sdt, Password=:password WHERE Id=:id";
    try {
        $statement = $connect->prepare($query);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':sdt', $sdt, PDO::PARAM_STR);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        if ($statement->execute()) {
            return true;
        } else return false;
    } catch (PDOException $e) {
    }
}

function GetAllUser() //get all user in database
{
    global $connect;
    $query = "SELECT * FROM User";
    try {
        $statement = $connect->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            $result = $statement->fetchAll();
            return $result;
        } else return false;
    } catch (PDOException $e) {
    }
}

function GetAllSV() //get all SinhVien user in database
{
    global $connect;
    $query = "SELECT Id,HoTen,Email,SĐT,GPA FROM User INNER JOIN SinhVien SV on User.Id = SV.IdSinhVien";
    try {
        $statement = $connect->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            $result = $statement->fetchAll();
            return $result;
        } else return false;
    } catch (PDOException $e) {
    }
}

function GetAllGV() //get all GiaoVien user in database
{
    global $connect;
    $query = "SELECT Id,HoTen,Email,SĐT,Khoa,NamKinhNghiem FROM User INNER JOIN GiaoVien GV on User.Id = GV.IdGiaoVien";
    try {
        $statement = $connect->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            $result = $statement->fetchAll();
            return $result;
        } else return false;
    } catch (PDOException $e) {
    }
}


function GetSVById($id) //get SinhVien user with Id
{
    global $connect;
    $query = "SELECT Id,HoTen,Email,SĐT,Username,Password,GPA FROM User INNER JOIN SinhVien SV on User.Id = SV.IdSinhVien WHERE Id = :id";
    try {
        $statement = $connect->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            $result = $statement->fetch();
            return $result;
        } else return false;
    } catch (PDOException $e) {
    }
}

function GetGVById($id) //get GiaoVien user wiht Id
{
    global $connect;
    $query = "SELECT Id,HoTen,Email,SĐT,Username,Password,Khoa,NamKinhNghiem FROM User INNER JOIN GiaoVien GV on User.Id = GV.IdGiaoVien WHERE Id = :id";
    try {
        $statement = $connect->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            $result = $statement->fetch();
            return $result;
        } else return false;
    } catch (PDOException $e) {
    }
}

function EditInfoSinhVien($id, $name, $email, $sdt, $username, $password, $GPA) //edit profile for SinhVien user (use for GiaoVien user)
{
    global $connect;
    $check = 0;
    //update profile in User table
    $query1 = "UPDATE User SET HoTen=:name, Email=:email, SĐT=:sdt, Username=:username, Password=:password WHERE Id=:id";
    try {
        $statement = $connect->prepare($query1);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':sdt', $sdt, PDO::PARAM_STR);
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        if ($statement->execute()) {
            $check = $check + 1;
        } else return false;
    } catch (PDOException $e) {
    }
    //update profile in SinhVien table
    $query2 = "UPDATE SinhVien SET GPA=:gpa WHERE IdSinhVien=:id";
    try {
        $statement1 = $connect->prepare($query2);
        $statement1->bindValue(':gpa', $GPA, PDO::PARAM_STR);
        $statement1->bindValue(':id', $id, PDO::PARAM_STR);
        if ($statement1->execute()) {
            $check = $check + 1;
        } else return false;
    } catch (PDOException $e) {
    }
    if ($check === 2) return true;
    else return false;
}

function EditInfoGiaoVien($id, $name, $email, $sdt, $username, $password, $khoa, $namkinhnghiem) //edit profile for GiaoVien user (use for GiaoVien user)
{
    global $connect;
    $check = 0;
    //update profile in User table
    $query1 = "UPDATE User SET HoTen=:name, Email=:email, SĐT=:sdt, Username=:username, Password=:password WHERE Id=:id";
    try {
        $statement = $connect->prepare($query1);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':sdt', $sdt, PDO::PARAM_STR);
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        if ($statement->execute()) {
            $check = $check + 1;
        } else return false;
    } catch (PDOException $e) {
    }
    //update profile in SinhVien table
    $query2 = "UPDATE GiaoVien SET Khoa=:khoa, NamKinhNghiem=:namkinhnghiem WHERE IdGiaoVien=:id";
    try {
        $statement = $connect->prepare($query2);
        $statement->bindValue(':khoa', $khoa, PDO::PARAM_STR);
        $statement->bindValue(':namkinhnghiem', $namkinhnghiem, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        if ($statement->execute()) {
            $check = $check + 1;
        } else return false;
    } catch (PDOException $e) {
    }
    if ($check === 2) return true;
    else return false;
}

?>