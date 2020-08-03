<?php

require_once("crud.php");
//require_once("mailerClass.php");

class Auth extends Crud
{




    function newAccount($conn, $value, $data, $columns)
    {
        $tableName = "hc_users";
        $columnName = "user_phone";
        if ($this->checkIfExists($conn, $tableName, $columnName, $value) == "youcanproceed") {
            if ($this->storeData($conn, $tableName, $data, $columns) == "success") {
                echo "savesuccessful";
            } else {
                echo "storefailed";
            }
        } else {
            echo "userexists";
        }
    }

    function signup($conn, $fname, $lname, $email, $pass1, $pass2, $phone, $refid)
    {
        //Run a query to check for the email address
        $checkEmail = $conn->query("SELECT * FROM users WHERE email = '$email' OR phone = '$phone'");
        //Check if the email address exixts on the database
        //If it exists, throw a message and end the function
        if ($conn->affected_rows > 0) {
            echo "emailexists";
            return;
        } else {
            //proceed with signup
            //First, check if passwords are identical
            if ($pass1 !== $pass2) {
                //..if they're not identical print a message and end the function
                die("passwordmismatch");
            } else {
                $password = password_hash($pass1, PASSWORD_DEFAULT);
                $createAccount = $conn->prepare("INSERT INTO users (fname, lname, email, phone,  password, referphone) VALUES (?, ?, ?, ?, ?, ?)");
                $createAccount->bind_param("ssssss", $fname, $lname, $email, $phone, $password, $refid);
                if ($createAccount->execute()) {
                    // $this->welcomeScholar($fname, $email);
                    echo "success";
                }
            }
        }
    }

    function login($conn, $value, $columnName, $tableName, $password)
    {
        $data = "user_phone";
        if ($this->fetchDataWhere($conn, $value, $columnName, $tableName) == "nodatafound") {
            echo "usernameerror";
        } else {
            $payLoad = $this->fetchDataWhere($conn, $value, $columnName, $tableName);
            $hashedPass = $payLoad['user_pass'];
            if (password_verify($password, $hashedPass)) {
                session_start();
                $_SESSION['userid'] = $payLoad['ID'];
                header("location:../index.php");
            } else {
                echo "loginfailure";
            }
        }
    }

    function isLoggedIn()
    {
        if (basename($_SERVER['PHP_SELF']) == "register.php" || basename($_SERVER['PHP_SELF']) == "login.php") {
            return;
        } else {
            session_start();
            if (!isset($_SESSION['userid'])) {
                $this->logout();
            }
        }
    }
    public function userData($conn)
    {
        if (basename($_SERVER['PHP_SELF']) == "register.php" || $_SERVER['PHP_SELF'] == "login.php") {
            return;
        } else {
            $session = $_SESSION['userid'];
            $userInfo = $conn->query("SELECT * FROM users WHERE id = '$session'");
            if ($conn->affected_rows == 1) {
                $userProfile = $userInfo->fetch_assoc();
                return $userProfile;
            }
        }
    }

    public function greet($name)
    {
        print "Hello world!" . $name;
    }

    public function forgotPassowrd($conn)
    {
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("location:login.php");
    }
}

$checkUsers = new Auth();
