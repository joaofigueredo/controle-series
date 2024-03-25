<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['password'] = Hash::make($data['password']);
        dd($data);

        $user = User::create($data);
        Auth::login($user);

        return to_route('series.index');
    }
}
