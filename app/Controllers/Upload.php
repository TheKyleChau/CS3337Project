<?php

namespace App\Controllers;

class Upload extends BaseController
{
  protected $helpers = ['form'];

  public function index()
  {
      return view('upload/upload', ['errors' => []]);
  }
  public function upload()
  {
    if(!isset($_SESSION['username'])) {
      return redirect()->route('Login');
    }
    else {
      $db = new \App\Models\MediaModel();
      $server = $db->initalize();
      $validationRule = [
              'userfile' => [
                  'label' => 'Image File',
                  'rules' => [
                      'uploaded[userfile]',
                      'is_image[userfile]',
                      'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                      'max_size[userfile,100]',
                      'max_dims[userfile,1024,768]',
                  ],
              ],
          ];
          if (! $this->validate($validationRule)) {
              $data = ['errors' => $this->validator->getErrors()];
              return view('upload/upload', $data);
          }

          $img = $this->request->getFile('userfile');

          if (! $img->hasMoved()) {
              $filepath = WRITEPATH . 'uploads/' . $_SESSION['username'] .  '/' . $img->store();
              $data = ['uploaded_fileinfo' => new File($filepath)];

              return view('upload/uploaded', $data);
          }

          $data = ['errors' => 'The file has already been moved.'];

          return view('upload/upload', $data);
      }
    }
  }
