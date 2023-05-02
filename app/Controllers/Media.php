<?php

namespace App\Controllers;

use App\Models\MediaModel;
use CodeIgniter\Controller;

class Media extends Controller
{
    public function index()
    {
        $mediaModel = new \App\Models\MediaModel();
        $userId = session()->get("userid");
        $data['media'] = $mediaModel->findAllByUserId($userId);
        return view('media', $data);
    }
}
