<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
      return view('login/login'); //Returns Login page from Views folder
    }
    public function logout()
    {
        $user_data = $this->session->all_userdata();
            foreach ($user_data as $key => $value) {
                if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                    $this->session->unset_userdata($key);
                }
            }
        $this->session->sess_destroy();
        redirect('Index');
    }
    public function login() {
      $db = new \App\Models\ServerModel();
      $server = $db->initalize();
      if (isset($_POST['login_user'])) {
          $username = $_POST["username"];
          $password = $_POST["password"];
          if (empty($username)) {
              array_push($errors, "Username is required");
          }
          if (empty($password)) {
              array_push($errors, "Password is required");
          }
          $data = array("username" => $username, "password" => $password);
          $db->login($data, $server);
        }
    }
}
