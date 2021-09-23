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
    public function update(UpdateRequest $request)
    {
        $user = auth()->user();

        $user->email = $request->filled('email') ? $request->email : $user->email;
        $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
        
        if($user->isBusiness()) {
            $businessName = $request->filled('business_name') ? $request->business_name : $user->business()->name;
            $user->business()->update([
                'name' => $businessName,
            ]);
        }

        $user->save();

        return Response::successMessage('Profile updated');
    }

    public function index()
    {
        return new UserAuthResource(auth()->user()->load('devices'));
    }

    public function logout(DeviceLogoutRequest $request, UserLogin $device)
    {
        $device->active = 0;
        $device->save();

        return Response::successMessage('Device has been logged out');
    }

    public function notification(Request $request)
    {
        return Response::successMessage('Notifications updated');
    }
}
