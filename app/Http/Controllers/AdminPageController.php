<?php

namespace W4P\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\Setting;
use W4P\Models\Project;
use W4P\Models\Donation;
use W4P\Models\DonationKind;
use W4P\Models\DonationType;
use W4P\Models\Tier;

use View;
use Redirect;
use Validator;
use Request;
use Image;
use Mail;
use Session;

class AdminPageController extends Controller
{

    /* ============================== */
    /* How does it work?
    /* ============================== */

    public function editHowDoesItWork()
    {

    }

    public function saveHowDoesItWork()
    {

    }

    /* ============================== */
    /* Press materials
    /* ============================== */

    public function editPressMaterials()
    {

    }

    public function savePressMaterials()
    {

    }

    /* ============================== */
    /* TOS
    /* ============================== */

    public function editTermsOfUse()
    {

    }

    public function saveTermsOfUse()
    {

    }

    /* ============================== */
    /* Privacy policy
    /* ============================== */

    public function editPrivacyPolicy()
    {

    }

    public function savePrivacyPolicy()
    {

    }
}
