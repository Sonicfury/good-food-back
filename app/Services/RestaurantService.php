<?php

namespace App\Services;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Collection;

class RestaurantService
{
    /**
     * @param $get_coords
     * @return Collection
     */
    public function restaurant_with_km($get_coords): Collection
    {
        $coords = explode(',', $get_coords);
        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {
            if($restaurant->lat && $restaurant->long){
                $distanceKm = round(
                    self::geo_distance(
                        (float)$coords[0],
                        (float)$coords[1],
                        (float)$restaurant->lat,
                        (float)$restaurant->long
                    ), 2);
                $restaurant->distanceKm = $distanceKm;
            }
        }

        return $restaurants;
    }

    /**
     * @param float $latitude1
     * @param float $longitude1
     * @param float $latitude2
     * @param float $longitude2
     * @return float
     */
    public static function geo_distance(float $latitude1, float $longitude1, float $latitude2, float $longitude2): float
    {
        $earthRadius = 6371.0088;

        $phi1 = deg2rad($latitude1);
        $phi2 = deg2rad($latitude2);
        $deltaLambda = deg2rad($longitude1 - $longitude2);

        $deltaSigma = acos(min(max(sin($phi1) * sin($phi2) + cos($phi1) * cos($phi2) * cos($deltaLambda), -1.0), 1.0));

        return $earthRadius * $deltaSigma;
    }
}
