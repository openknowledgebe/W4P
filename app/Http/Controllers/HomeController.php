<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\Setting;
use W4P\Models\Tier;
use W4P\Models\Post;
use W4P\Models\DonationType;
use W4P\Models\DonationKind;
use W4P\Models\Donation;

// use W4P\Facades\Mollie;

use Redirect;
use View;
use W4P\Models\Project;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Start point for the application
     * @return string
     */
    public function index(Request $request)
    {
        // Get the project
        $project = $request->project;

        // Get all donation types & kinds
        $donationTypes = DonationType::all()->groupBy('kind');
        $donationKinds = DonationKind::all();

        // Get the last 5 posts
        $posts = Post::orderBy('created_at', 'DESC')->limit(5)->get();

        // Get when the project runs out
        $ends_at = new Carbon($project->ends_at);
        $now = Carbon::now();
        $leftDays = $now->diffInDays($ends_at);
        $leftHours = $now->diffInHours($ends_at);

        // Get how many contributors there are
        $donorQuery = Donation::whereNotNull('confirmed')->get();
        $donorCount = $donorQuery->groupBy('email')->count();
        $contributed = $donorQuery->sum('currency');

        // Calculate the contributed percentage of the total amount of money
        $contributedPercentage = 0;
        if ($project->currency > 0) {
            $contributedPercentage = round(($contributed / $project->currency) * 100, 1);
            if ($contributedPercentage > 100) {
                $currencyPercentage = 100;
            } else {
                $currencyPercentage = $contributedPercentage;
            }

        } else {
            $currencyPercentage = null;
        }

        // Get percentages from donations (for 4 kinds -> manpower, coaching, etc.)
        $percentages = DonationKind::getAllPercentages($donorQuery);
        $totalPercentage = round(
            DonationKind::getTotalPercentage($percentages, $currencyPercentage)
        );

        // Get tier counts
        $tierCounts = Tier::getCounts();

        // Return the view with all the data
        return View::make('front.home')
            ->with("project", $project)
            ->with("posts", $posts)
            ->with("data", Setting::getBeginsWith('organisation.'))
            ->with("tiers", Tier::all()->sortBy('pledge'))
            ->with("hoursleft", $leftHours)
            ->with("daysleft", $leftDays)
            ->with('donationTypes', $donationTypes)
            ->with('donationKinds', $donationKinds)
            ->with('donorCount', $donorCount)
            ->with('contributed', $contributed)
            ->with('contributedPercentage', $contributedPercentage)
            ->with('percentages', $percentages)
            ->with('tierCounts', $tierCounts)
            ->with('totalPercentage', $totalPercentage);
    }

    /**
     * How does it work page
     * @return mixed
     */
    public function how()
    {
        return View::make('front.how');
    }

    /**
     * Previous projects page
     * @return mixed
     */
    public function previous()
    {
        // TODO: Get previous projects
        return View::make('front.previous')->with('previous', []);
    }

    /**
     * Press page
     * @return mixed
     */
    public function press()
    {
        return View::make('front.press');
    }

    /**
     * Terms of use page
     * @return mixed
     */
    public function terms()
    {
        return View::make('front.terms');
    }

    /**
     * Privacy policy page
     * @return mixed
     */
    public function privacy()
    {
        return View::make('front.privacy');
    }
}
