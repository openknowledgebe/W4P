<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use URL;

class UploadController extends Controller
{
    public function inlineAttach()
    {
        $uploadFolder = public_path() . '/images/';
        $onlinePath = URL::to('images');
        $response = array();
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $filename = uniqid() . '.' . (pathinfo($file['name'], PATHINFO_EXTENSION) ? : 'png');
            move_uploaded_file($file['tmp_name'], $uploadFolder . $filename);
            $response['filename'] = $onlinePath . "/" . $filename;
        } else {
            $response['error'] = 'Error while uploading file';
        }
        echo json_encode($response);
    }
}
