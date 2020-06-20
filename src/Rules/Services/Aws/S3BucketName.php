<?php

namespace Weap\LaravelValidationRules\Rules\Services\Aws;

use Illuminate\Contracts\Validation\Rule;

class S3BucketName implements Rule
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
        if (substr($value, 0, 4) == 'xn--') {
            return false;
        }
        
        return (bool) (preg_match('/^(?=^.{3,63}$)(?!^(\d+\.)+\d+$)(^(([a-z0-9]|[a-z0-9][a-z0-9\-]*[a-z0-9])\.)*([a-z0-9]|[a-z0-9][a-z0-9\-]*[a-z0-9])$)/', $value) == 1);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid S3 bucket name.';
    }
}
