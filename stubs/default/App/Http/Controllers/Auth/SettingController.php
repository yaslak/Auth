<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class SettingController extends Controller
{
    public function setting(SettingRequest $request)
    {
        Auth::user()->update(
            $request->safe()->only(['name', 'email'])
        );

        return back()->with('status', __('setting.info'));
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        auth()->user()->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        return back()->with('status', __('setting.password'));
    }
}
