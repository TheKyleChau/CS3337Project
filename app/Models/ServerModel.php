<?php

namespace App\Models;

use CodeIgniter\Model;

class ServerModel extends Model
{
  protected $DBGroup = 'default';
  protected $table      = 'UserNameAndPassword';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType     = 'array';
  protected $useSoftDeletes = true;
  protected $allowedFields = ['name', 'email','username','password'];
  function initalize() {
    return $db = \Config\Database::connect();
  }
  function login($data, $db) {
      $username = $data['username'];
      $password = $data['password'];
      $salt = "SELECT salt FROM UserNameAndPassword WHERE username='$username'";
      $result = $db->query($salt);
      foreach ($result->getResultArray() as $row) {
          $saltresult = $row['salt'];
      }
      $password = md5($password . $saltresult);
      $querycheck = "SELECT * FROM UserNameAndPassword WHERE username='$username' AND password='$password'";
      $query = $db->query($querycheck);
      $numRows = count($query->getResult());
      $hashuser = md5($username);
      var_dump($numRows);
      if ($numRows == 1) {
          setcookie("login", $hashuser . $saltresult . $password, time()+3600);
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
      } else {
          array_push($errors, "Wrong username/password combination");
      }
  }
  function register($data, $db) {
    $username = "";
    $email    = "";
    $salt = "";
    $errors = array();
    $db = model('App\Models\ServerModel');
    if (isset($_POST['reg_user'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 = $_POST['password_1'];
        $password_2 = $_POST['password_2'];
        $query = "SELECT * FROM UserNameAndPassword WHERE username='$username' OR email='$email' LIMIT 1";
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
        $query = $db->query($query);
        $result = $query->getResultArray();
        $user = count($result);
        $resultarray = array();
        if ($user != 0) { // if user exists
            foreach ($result as $r) {
                $resultarray['username'] = $r['username'];
                $resultarray['email'] = $r['email'];
            }
            if ($resultarray['username'] === $username) {
                array_push($errors, "Username already exists");
            }

            if ($resultarray['email'] === $email) {
                array_push($errors, "email already exists");
            }
        }
        if (count($errors) == 0) {
            $salt = bin2hex(random_bytes(10));
            $password_1 .= $salt;
            $password = md5($password_1);//encrypt the password before saving in the database
            $hashuser = md5($username);
            $query = "INSERT INTO UserNameAndPassword (username, email, password, salt)
              VALUES('$username', '$email', '$password','$salt')";
            $db->query($query);
            setcookie("login", $salt . $password, time()+3600);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
        }
    }
  }



}
