<?php

namespace App\Http\Controllers\Api\Profile;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\DeviceLogoutRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Resources\User\UserAuthResource;
use App\Models\User;
use App\Models\UserLogin;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(User $profile, UpdateRequest $request)
    {

        $profile->email = $request->filled('email') ? $request->email : $profile->email;
        $profile->password = $request->filled('password') ? Hash::make($request->password) : $profile->password;

        $profile->save();

        return Response::successMessage('Profile updated');
    }

    public function index()
    {
        return new UserAuthResource(auth()->user()->load('devices'));
    }

    public function logout(DeviceLogoutRequest $request, UserLogin $device)
    {
        dd($device->id);
        $device->active = 0;
        $device->save();

        return Response::successMessage('Device has been logged out');
    }

    public function notification(Request $request)
    {
        return Response::successMessage('Notifications updated');
    }
}
