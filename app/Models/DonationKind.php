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

            $weights = Setting::getBeginsWith("weight.");

            $kinds[$kind] = [
                "percentage" => $percentage,
                "items" => $subitems,
                "custom_weight" => (array_key_exists("weight." . $kind, $weights)
                    ? (int)$weights["weight." . $kind] : null),
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
        // Start counting at 0 for categories and weight
        $totalCategories = 0;
        $totalWeight = 0;

        // Default weight is 1 (if unset)
        $defaultWeight = 1;

        // Total weight calculation
        foreach ($categoryPercentages as $key => $category) {
            // Items must be present or currency must be set for items to count towards to total weight
            if (count($category["items"]) > 0 || ($key == "currency" && $currencyPercentage !== null)) {
                if (array_key_exists("custom_weight", $category) && $category["custom_weight"] !== null) {
                    $totalWeight += $category["custom_weight"];
                } else {
                    $totalWeight += $defaultWeight;
                }
            }
        }

        // Total category count calculation (valid)
        $total = 0;
        foreach ($categoryPercentages as $key => $category) {
            // Items must be present or currency must be set for items to count towards to total weight
            if (count($category["items"]) > 0 || ($key == "currency" && $currencyPercentage !== null)) {
                $totalCategories++;
            }
        }

        // Total is amount of categories tops
        if ($totalCategories > 0 && $totalWeight > 0) {
            foreach ($categoryPercentages as $kind => $category) {
                $weight = $defaultWeight;
                // If custom weight is set and valid
                if (array_key_exists("custom_weight", $category) && $category["custom_weight"] !== null) {
                    $weight = $category["custom_weight"];
                }
                // Items must be present or currency must be set for items to count towards to total weight
                if (count($category["items"]) > 0 || ($kind == "currency")) {
                    // If the currency is set, get the more precise currency percentage
                    if ($kind == "currency") {
                        $category["percentage"] = $currencyPercentage;
                    }
                    $total = $total + ($category["percentage"] * ($weight / $totalWeight));
                }
            }
            return $total;
        } else {
            return 0;
        }
    }
}