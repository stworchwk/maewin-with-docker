<?php

namespace App\Http\Controllers;

use App\CheckRequest;
use App\Plan;
use App\PlanLocation;
use App\PlanTracking;
use App\SystemMessage;
use Illuminate\Http\Request;

class TravelerPlanController extends Controller
{
    public function index()
    {
        $data = [
            'plans' => Plan::all(),
        ];
        return view('pages.travelerPlans.index', $data);
    }

    public function achievement($id)
    {
        return view('pages.travelerPlans.components.achievements', ['plan' => Plan::findOrFail($id)]);
    }

    public function messages($id)
    {
        $data = [
            'plan' => Plan::findOrFail($id),
            'checkRequests' => CheckRequest::all()
        ];
        return view('pages.travelerPlans.components.messages', $data);
    }

    public function logs($id)
    {
        return view('pages.travelerPlans.components.logs', ['plan' => Plan::findOrFail($id)]);
    }

    public function callPlanLocations($id)
    {
        return response()->json(PlanLocation::with('location.category')->where('plan_id', $id)->get());
    }

    public function callPlanTracking($id)
    {
        return response()->json(PlanTracking::where('plan_id', $id)->orderBy('tracking_date_time', 'desc')->get());
    }
}
