<?php

namespace App\Http\Controllers;

use App\Models\Pilrember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PillResource;

class PilremberController extends Controller
{
    public function getRemenbers()
    {
        $pills = Pilrember::where('user_id', auth()->id() ?? 1)->orderBy('id', 'desc')->get();

        return PillResource::collection($pills);
    }

    public function storeRemenber(Request $request)
    {
        $request->validate([
            'medicine_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'reminder_time' => 'required',
            'frequency' => 'required|string',
            'form' => 'required|string',
        ]);

        $reminder = Pilrember::create([
            'user_id' => auth()->id() ?? 1,
            'medicine_name' => $request->medicine_name,
            'start_date' => $request->start_date,
            'reminder_time' => $request->reminder_time,
            'form' => $request->form,
            'frequency' => $request->frequency,
        ]);

        return new PillResource($reminder);
    }

    public function deleteRemenber(Pilrember $pilrember)
    {
        $pilrember->delete();

        return new PillResource($pilrember);

    }
}
