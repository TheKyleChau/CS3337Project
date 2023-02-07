<?php

$userModel = new \App\Models\ServerModel();

session_start();
$username = "";
$email    = "";
$salt = "";
$errors = array();
$db = mysqli_connect('localhost', 'cs3337', 'cs3337Pa$$w0rd', 'CS3337');
if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
    $user_check_query = "SELECT * FROM UserNameAndPassword WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $salt = bin2hex(random_bytes(10));
        $password_1 .= $salt;
        $password = md5($password_1);//encrypt the password before saving in the database
        $hashuser = md5($username);
        $query = "INSERT INTO UserNameAndPassword (username, email, password, salt)
  			  VALUES('$username', '$email', '$password','$salt')";
        mysqli_query($db, $query);
        setcookie("login", $salt . $password, time()+3600);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $salt = "SELECT salt FROM UserNameAndPassword WHERE username='$username'";
        $salt = mysqli_query($db, $salt);
        $saltresult = $salt->fetch_array()[0] ?? '';
        $password = md5($password . $saltresult);
        $query = "SELECT * FROM UserNameAndPassword WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        $hashuser = md5($username);
        if (mysqli_num_rows($results) == 1) {
            setcookie("login", $hashuser . $saltresult . $password, time()+3600);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
