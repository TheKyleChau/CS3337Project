<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index()
    {
      return view('register/register'); //Returns Login page from Views folder
    }
    public function register() {
      if (!isset($_SESSION))
      {
        session_start();
      }
      $db = new \App\Models\ServerModel();
      $server = $db->initalize();
      $errors = array();
      if (isset($_POST['reg_user'])) {
          $username = $db->escape(trim($_POST['username']));
          $password_1 = $db->escape(trim($_POST['password_1']));
          $email = $db->escape(trim($_POST['email']));
          if (empty($username)) {
              array_push($errors, "Username is required");
          }
          if (empty($password_1)) {
              array_push($errors, "Password is required");
          }
          if(empty($errors)) {
            $data = array('username' => $username, 'password' => $password_1, 'email' => $email);
            $db->register($data, $server);
          }
          return redirect()->route('Index');
        }
      }
}
