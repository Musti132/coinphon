<?php

namespace App\Rules;

use App\Models\WalletType;
use Illuminate\Contracts\Validation\Rule;

class WalletTypeExist implements Rule
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
        return WalletType::where('name', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wallet type doesnt exist';
    }
}
