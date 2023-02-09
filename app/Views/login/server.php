<?php

$db = mysqli_connect('localhost', 'cs3337', 'cs3337Pa$$w0rd', 'CS3337');

session_start();
$username = "";
$email    = "";
$salt = "";
$errors = array();
