<?php

namespace App\Http\Controllers;

use App\Location;
use App\Plan;
use App\PlanTracking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        $data = [
            'is_monitor' => true,
        ];
        return view('pages.monitors.index', $data);
    }

    //API
    public function callLocations()
    {
        return response()->json(Location::select('id', 'location_category_id', 'title_th', 'latitude', 'longitude', 'thumbnail', 'active')->where('active', 1)->with('category')->get());
    }

    public function callTravelerPlans()
    {
        $data = [];
        $plans = Plan::where('plan_status', 1)->get();
        foreach ($plans as $plan) {
            $tracking = PlanTracking::where('plan_id', $plan->id)->orderByDesc('tracking_date_time')->first();
            $tracking_pass_time = Carbon::parse($tracking->tracking_date_time)->diffInMinutes(Carbon::now());

            if ($tracking_pass_time < 5) {
                $tracking_status = 1;
            } elseif ($tracking_pass_time < 10) {
                $tracking_status = 2;
            } else {
                $tracking_status = 3;
            }

            $local_data = [
                'id' => $plan->id,
                'code' => $plan->code,
                'traveler_full_name' => $plan->traveler ? $plan->traveler->full_name : '',
                'traveler_id_card' => $plan->traveler ? $plan->traveler->id_card : '',
                'traveler_nationality' => $plan->traveler ? ($plan->traveler->nationality ? $plan->traveler->nationality->name_th : '') : '',
                'traveler_phone_number' => ($plan->traveler ? ($plan->traveler->prefixPhone ? $plan->traveler->prefixPhone->prefix : '##') : '##') . ' ' . $plan->traveler ? $plan->traveler->phone_number : '#########',
                'rescue_status' => $plan->rescue_status,
                'latitude' => $tracking->latitude,
                'longitude' => $tracking->longitude,
                'tracking_status' => $tracking_status
            ];
            array_push($data, $local_data);
        }
        return response()->json($data);
    }
    //END API
}
