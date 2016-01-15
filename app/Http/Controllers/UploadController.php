<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use URL;

use W4P\Models\Setting;

class UploadController extends Controller
{
    public function inlineAttach()
    {
        $uploadFolder = public_path() . '/images/';
        $onlinePath = URL::to('images');
        $response = [];

        if (Input::get('token') == Setting::get('token')) {
            // If authentication token matches, proceed with the upload
            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];
                $filename = uniqid() . '.' . (pathinfo($file['name'], PATHINFO_EXTENSION) ? : 'png');
                move_uploaded_file($file['tmp_name'], $uploadFolder . $filename);
                $response['filename'] = $onlinePath . "/" . $filename;
            } else {
                $response['error'] = 'Error while uploading attachment.';
            }
        } else {
            $response['error'] = "You do not have permission to upload an attachment.\n" .
            "It is possible that your session has expired. Try logging in again.";
        }
        return json_encode($response);
    }
}
