<?php

namespace App\Models;

use CodeIgniter\Model;

class ServerModel extends Model
{
  function initalize() {
    return $db = \Config\Database::connect();
  }
  function login($data, $db) {
      if(!$data["username"] OR !$data["password"]) redirect('Index');
      $username = $data["username"];
      $password = $data["password"];
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
      if ($numRows == 1) {
          setcookie("login", $hashuser . $saltresult . $password, time()+3600);
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
          redirect('Index');
      } else {
          array_push($errors, "Wrong username/password combination");
      }
  }
  function register() {
    $DBRegQuery = "SELECT * FROM UserNameAndPassword WHERE username='$username' OR email='$email' LIMIT 1";
  }
  protected $DBGroup = 'default';
  protected $table      = 'UserNameAndPassword';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType     = 'array';
  protected $useSoftDeletes = true;
  protected $allowedFields = ['name', 'email','username','password'];


}
