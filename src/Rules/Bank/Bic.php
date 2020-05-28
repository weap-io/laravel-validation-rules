<?php

namespace Weap\LaravelValidationRules\Rules\Bank;

use Illuminate\Contracts\Validation\Rule;

class Bic implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (bool) (preg_match('/^[a-z]{6}[0-9a-z]{2}([0-9a-z]{3})?\z/i', $value) == 1);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid BIC.';
    }
}
