<?php

namespace App\Models;

use CodeIgniter\Model;

class ServerModel extends Model
{
  function initalize() {
    $db = \Config\Database::connect();
  }
  protected $DBGroup = 'default';
  protected $table      = 'UserNameAndPassword';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType     = 'array';
  protected $useSoftDeletes = true;
  protected $allowedFields = ['name', 'email','username','password'];



}
