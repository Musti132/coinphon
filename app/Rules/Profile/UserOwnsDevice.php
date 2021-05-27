<?php

namespace App\Rules\Profile;

use App\Models\UserLogin;
use Illuminate\Contracts\Validation\Rule;

class UserOwnsDevice implements Rule
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
        return auth()->user()->devices()->where('id', $value)->where('user_id', auth()->id())->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid device';
    }
}
