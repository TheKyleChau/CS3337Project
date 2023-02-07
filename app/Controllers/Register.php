<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index()
    {
      return view('register/register'); //Returns Login page from Views folder
    }
}
