<?php

namespace App\Http\Controllers;

use App\Models\PlannedTask;
use App\Models\PlanType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $planTiles = [];
        $colors = ['yellow', 'info',  'teal', 'cyan', 'blue', 'default', 'primary'];
        $planType = PlanType::get();
        $indexColor = 0;
        foreach ($planType as $plan) {
            $planTile = [];
            $planTile['id'] = $plan->id;
            $planTile['title'] = 'Pianificazione '.$plan->name;
            $planTile['color'] = $colors[$indexColor];
            $planTile['count'] = PlannedTask::where('type_id', $plan->id)->where('completed', false)->count();
            array_push($planTiles, $planTile);
            $indexColor++;
        }
        $planTiles = array_chunk($planTiles, 2);
        // dd($planTiles);
        return view(
            'home',
            [
                'planTiles' => $planTiles
            ]
        );
    }
}
