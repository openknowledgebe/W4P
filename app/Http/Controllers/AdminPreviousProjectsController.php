<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Models\ArchivedProject;
use Illuminate\Support\Facades\Input;

use View;
use Validator;
use Session;
use Redirect;
use GuzzleHttp\Client;

class AdminPreviousProjectsController extends Controller
{
    public function index()
    {
        // Get all tiers
        $archived = ArchivedProject::all();
        return View::make('backoffice.previous.index')->with('archived', $archived);
    }

    public function delete($id)
    {
        ArchivedProject::find($id)->delete();
        Session::flash('info', 'This project has been removed from the previous projects list.');
        return Redirect::route('admin::previous');
    }

    public function showImportForm()
    {
        return View::make('backoffice.previous.import');
    }

    public function doImport()
    {
        $errors = [];

        $url = Input::get('url');

        if ($url == null) {
            $errors[] = "URL is not valid.";
        } else {
            // Make sure the URL ends with a backslash
            $url = rtrim($url, '/') . '/';
            // Normalize the URL
            $url = $url . 'details.json';

            $client = new Client();
            $res = $client->request('GET', $url);

            $status = $res->getStatusCode();
            $type = $res->getHeaderLine('content-type');
            $content = json_decode($res->getBody(), 1);

            if ($status == 200) {

                $project = $content['project'];
                $meta = $content['meta'];

                $success = false;
                if ($meta['total_percentage'] == 100) {
                    $success = true;
                }

                $archived = ArchivedProject::create(
                    [
                        "title" => $project['title'],
                        "brief" => $project['brief'],
                        "description" => $project['description'],
                        "video_url" => $project['video_url'],
                        "starts_at" => $project['starts_at'],
                        "ends_at" => $project['ends_at'],
                        "created_at" => $project['created_at'],
                        "updated_at" => $project['updated_at'],
                        "success" => $success,
                        "meta" => json_encode($meta)
                    ]
                );

            } else {
                $errors[] = "Status code did not return 200. Importing failed.";
            }
        }

        if (count($errors) > 0) {
            return Redirect::back()->withErrors($errors);
        } else {
            return Redirect::route('admin::previous');
        }
    }
}
