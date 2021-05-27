<?php

namespace App\Rules\Profile;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class EmailCheck implements Rule
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

        return User::where('email', $value)->where('id', '!=', auth()->user()->id)->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email already exist';
    }
}
