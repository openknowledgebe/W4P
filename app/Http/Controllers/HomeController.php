<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\ArchivedProject;
use W4P\Models\Setting;
use W4P\Models\Tier;
use W4P\Models\Post;
use W4P\Models\DonationType;
use W4P\Models\DonationKind;
use W4P\Models\Donation;
use W4P\Models\Page;

// use W4P\Facades\Mollie;

use Redirect;
use View;
use W4P\Models\Project;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Start point for the application
     * @param $request
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

        if ($ends_at->lte($now)) {
            $leftDays = 0;
            $leftHours = 0;
            $leftMinutes = 0;
        } else {
            $leftDays = $now->diffInDays($ends_at);
            $leftHours = $now->diffInHours($ends_at);
            $leftMinutes = $now->diffInMinutes($ends_at);
        }

        // Get how many contributors there are
        $donorQuery = Donation::whereNotNull('confirmed')->get();
        $donorCount = $donorQuery->groupBy('email')->count();
        $contributed = $donorQuery->sum('currency');

        // Calculate the contributed percentage of the total amount of money
        $contributedPercentage = 0;
        if ($project->currency > 0) {
            $contributedPercentage = floor(($contributed / $project->currency) * 100, 1);
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
        $totalPercentage = floor(
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
            ->with("minutesleft", $leftMinutes)
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
     * Previous projects page
     * @return mixed
     */
    public function showPrevious()
    {
        $previous = ArchivedProject::all();
        return View::make('front.pages.previous')->with('previous', $previous);
    }

    /**
     * How does it work page
     * @return mixed
     */
    public function how()
    {
        $page = Page::where('slug', 'how_it_works')->first();
        return View::make('front.pages.detail')->with('page', $page);
    }

    /**
     * Press page
     * @return mixed
     */
    public function press()
    {
        $page = Page::where('slug', 'press')->first();
        return View::make('front.pages.detail')->with('page', $page);
    }

    /**
     * Terms of use page
     * @return mixed
     */
    public function terms()
    {
        $page = Page::where('slug', 'terms_of_use')->first();
        return View::make('front.pages.detail')->with('page', $page);
    }

    /**
     * Privacy policy page
     * @return mixed
     */
    public function privacy()
    {
        $page = Page::where('slug', 'privacy_policy')->first();
        return View::make('front.pages.detail')->with('page', $page);
    }
}
