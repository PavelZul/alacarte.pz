<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\MaiExcellent\Models\Country;
use App\Modules\MaiExcellent\Models\Hotel;
use App\Modules\MaiExcellent\Services\ApiService;
use App\Modules\MaiExcellent\Services\DbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
//        User::create(['username' => 'ALACAR', 'password' => 'catttour']);
        return view('login');
    }

    public function login(Request $request, ApiService $apiService, DbService $dbService)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('username', 'password'), $request->filled('remember'))) {
            $dbService::store(new Hotel(), $apiService->authentication($request->input('username'), $request->input('password'))->allHotelsList());
            $dbService::store(new Country(), $apiService->authentication($request->input('username'), $request->input('password'))->countriesList());
            return redirect()->intended('/bookings');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
