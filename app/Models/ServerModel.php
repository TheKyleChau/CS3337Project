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
  protected $allowedFields = ['name', 'email','username','password','salt'];
  function initalize() {
    return $db = \Config\Database::connect();
  }
  function login($data, $db, $errors) {
      $username = $data['username'];
      $password = $data['password'];
      $salt = "SELECT salt FROM UserNameAndPassword WHERE username=". $db->escape($username);
      $resulty = $db->query($salt);
      foreach ($resulty->getResultArray() as $row) {
          $saltresult = $row['salt'];
      }
      if(count($resulty->getResultArray()) == 0) {
          array_push($errors, "Invalid user/pass combo");
      }
      else {
        $password = md5($password . $saltresult);
        $querycheck = "SELECT * FROM UserNameAndPassword WHERE username=". $db->escape($username) . "AND password=" . $db->escape($password);
        $query = $db->query($querycheck);
        $numRows = count($query->getResult());
        $hashuser = md5($username);
        if ($numRows == 1) {
            setcookie("login", $hashuser . $saltresult . $password, time()+3600);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
        }
        else {
          array_push($errors, "Invalid user/password combo");
          redirect()->route('Login');
        }
      }
  }
  function register($data, $db, $errors) {
    $username = "";
    $email    = "";
    $salt = "";
    $db = model('App\Models\ServerModel');
    if (isset($_POST['reg_user'])) {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $filter = '/[\'^£$%&*()}{#~?><>,|=_+¬-]/';
        if (preg_match($filter, $username) || preg_match($filter, $password))
        {
          array_push($errors, "Special characters not allowed");
          return redirect()->route('Register');
        }
        $query = "SELECT * FROM UserNameAndPassword WHERE username=" . $db->escape($username) . "OR email= " . $db->escape($email) . "LIMIT 1";
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        var_dump($errors);
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
            $password .= $salt;
            $password = md5($password);//encrypt the password before saving in the database
            $hashuser = md5($username);
            var_dump($salt);
            $builder = $db->table('UserNameAndPassword');
            $query = [
              'username' => $username,
              'email' => $email,
              'password' => $password,
              'salt' => $salt,
            ];
            var_dump($query);
            var_dump($builder->insert($query));
            setcookie("login", $salt . $password, time()+3600);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
        }
    }
  }
}
