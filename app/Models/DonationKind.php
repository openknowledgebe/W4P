<?php

namespace W4P\Models;

class DonationKind
{
    /**
     * Predefined 'categories'
     * @return array
     */
    public static function all()
    {
        return ['manpower', 'material', 'coaching', 'currency'];
    }

    /**
     * Get all percentages (Based on predefined 'categories')
     * @param $donationQuery: An existing query. If this is not supplied, an extra query will be done.
     * @return array
     */
    public static function getAllPercentages($donationQuery = null)
    {
        if ($donationQuery == null) {
            $donationQuery = Donation::whereNotNull('confirmed')->get();
        }
        $kinds = [];
        $donationIds = $donationQuery->pluck('id', null)->toArray();
        foreach (self::all() as $kind) {
            $subitems = [];
            // Get the types (created by admins)
            $types = DonationType::where('kind', $kind)->get();
            foreach ($types as $type) {
                // Get the count of donation items provided by users
                $total = DonationItem::where('donation_type_id', $type->id)
                    ->whereIn('donation_id', $donationIds)
                    ->count();
                $goal = (int)$type->required_amount;
                $percentage = $total / $goal;
                if ($percentage > 1) {
                    $percentage = 1;
                }
                $required = $goal - $total;
                if ($required < 0) {
                    $required = 0;
                }
                // Push subitems
                array_push($subitems, [
                    "id" => $type->id,
                    "type" => $type->name,
                    "total" => $total,
                    "goal" => $goal,
                    "reached" => $percentage, // total = 1, 100% = 1
                    "required" => $required
                ]);
            }

            // Calculate the general percentage
            if (count($subitems) > 0) {
                // Assume the weight is divided equally
                $defaultWeight = (1 / (int)count($subitems));
                $percentage = 0;
                // Calculate the sum of all subitems' percentages
                foreach ($subitems as $subitem) {
                    $percentage = $percentage + ($subitem["reached"] * $defaultWeight);
                }
            } else {
                // If no subitems, assume 0% complete since there is no goal
                $percentage = 0;
            }

            $percentage = round($percentage * 100, 2);
            if ($percentage > 100) {
                $percentage = 100;
            }
            $kinds[$kind] = [
                "percentage" => $percentage,
                "items" => $subitems
            ];
        }
        return $kinds;
    }

    /**
     * Get the total percentage
     * @param $categoryPercentages: Result of getAllPercentages
     * @param $currencyPercentage: Current currency percentage if applied
     * @return int Total percentage for the current project
     */
    public static function getTotalPercentage($categoryPercentages, $currencyPercentage = null)
    {
        $totalCategories = 0;

        $total = 0;
        foreach ($categoryPercentages as $category) {
            if (count($category["items"]) > 0) {
                $totalCategories++;
            }
        }
        if ($currencyPercentage != null) {
            $totalCategories++;
            $total = $total + ($currencyPercentage / $totalCategories);
        }

        // Total is amount of categories tops
        if ($totalCategories > 0) {
            foreach ($categoryPercentages as $category) {
                if (count($category["items"]) > 0) {
                    $total = $total + ($category["percentage"] / $totalCategories);
                }
            }
            return $total;
        } else {
            return 0;
        }
    }
}