<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
  protected $DBGroup = 'default';
  protected $table      = 'Media';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType     = 'array';
  protected $useSoftDeletes = true;
  protected $allowedFields = ['userid', 'url','mediatype','cover','caption','filename'];
  function initalize() {
    return $db = \Config\Database::connect();
  }
  function upload($data, $db, $errors) {
      $username = $data['username'];
      $querycheck = "SELECT * FROM UserNameAndPassword WHERE username=". $db->escape($username);
      $query = $db->query($querycheck);
      $numRows = count($query->getResult());
      $hashuser = md5($username);
      if ($numRows == 1) {

      }
      var_dump($query);
  }
}
