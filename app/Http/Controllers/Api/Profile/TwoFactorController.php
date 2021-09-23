<?php

namespace App\Http\Controllers\Api\Profile;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    
    public function enable(Request $request) {
        auth()->user()->settings()->set('2fa_enabled', true);

        if($request->filled('phone')) {
            $phone = auth()->user()->phone()->update([
                'number' => $request->phone,
            ]);
        }

        $phone = auth()->user()->phone()->with('country')->get();
        
        return Response::success($phone, '2FA Enabled');
    }

    public function disable(Request $request) {
        auth()->user()->settings()->set('2fa_enabled', false);

        return Response::successMessage('2FA Disabled');
    }
}
