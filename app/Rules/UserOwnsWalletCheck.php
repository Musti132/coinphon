<?php

namespace App\Rules;

use App\Models\Wallet;
use App\Models\Webhook;
use Illuminate\Contracts\Validation\Rule;

class UserOwnsWalletCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $wallet = Wallet::where('uuid', $value)->first();

        if(!$wallet){
            return false;
        }

        if($wallet->user_id !== auth()->id()){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Forbidden/Wallet not found';
    }
}
