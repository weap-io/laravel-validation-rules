<?php

namespace Weap\LaravelValidationRules\Rules\Network;

use Illuminate\Contracts\Validation\Rule;

class Port implements Rule
{
    protected $allowZero = false;

    public function __construct(bool $allowZero = false)
    {
        $this->allowZero = $allowZero;
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
        $min = 1;
        $max = 65535;

        if ($this->allowZero) {
            $min = 0;
        }

        $value = (int) $value;

        return $value >= $min && $value <= $max;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field must be a valid port number.';
    }
}