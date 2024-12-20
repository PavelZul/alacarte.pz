<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MaiExcellent\Models\Country;
use App\Modules\MaiExcellent\Models\Hotel;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $hotels = Hotel::when($request->country_id, function ($query) use ($request) {
            return $query->where('country_id', $request->country_id);
        })
            ->when($request->check_in, function ($query) use ($request) {

            })
            ->when($request->check_out, function ($query) use ($request) {

            })
            ->paginate(10);

        return view('bookings.index');
    }
}
