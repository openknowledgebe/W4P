<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use URL;

use W4P\Models\Setting;

class UploadController extends Controller
{
    /**
     * Upload an image that was dropped in a Markdown box.
     * @return mixed
     */
    public function inlineAttach()
    {
        // Set up the upload folder
        $uploadFolder = public_path() . '/images/';

        // Set up the path to the images
        $onlinePath = URL::to('images');

        // Set up the response object
        $response = [];

        // Check if the tokens match (= current admin)
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
        return response()->json($response);
    }
}
