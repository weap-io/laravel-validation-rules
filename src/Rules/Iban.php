<?php

namespace Weap\LaravelValidationRules\Rules;

use IBAN as IbanValidator;
use Illuminate\Contracts\Validation\Rule;

class Iban implements Rule
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
        return (new IbanValidator($value))->VerifyMachineFormatOnly();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid IBAN.';
    }
}
