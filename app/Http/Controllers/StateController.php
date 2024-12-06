<?php

namespace App\Http\Controllers;

use App\Http\Resources\StateResource;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class StateController extends Controller
{
    private string $key = 'directories:states';

    public function index()
    {
        $daysInMonth = Carbon::now()->daysInMonth;
        $secondsInMonth = $daysInMonth * 24 * 60 * 60;

        $states = Cache::remember($this->key, $secondsInMonth, function () {
            return State::all();
        });

        return response()->json([
            'status' => 'success',
            'data' => StateResource::collection($states)
        ]);
    }
}
