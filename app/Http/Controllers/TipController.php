<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipResource;
use App\Models\Tip;
use Carbon\Carbon;

class TipController extends Controller
{
    public function getTips()
    {
        $today = Carbon::today()->toDateString();
        $tips = Tip::where('date_for', $today)->get();
        if ($tips->count() < 3) {
            Tip::whereNotNull('date_for')->update(['date_for' => null]);
            $tips = Tip::inRandomOrder()->limit(3)->get();
            foreach ($tips as $tip) {
                $tip->date_for = $today;
                $tip->save();
            }
        }

        return TipResource::collection($tips);

    }
}
