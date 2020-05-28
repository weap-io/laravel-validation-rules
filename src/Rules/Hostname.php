<?php

namespace Weap\LaravelValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;

class Hostname implements Rule
{
    protected $withTld = true;

    public function __construct(bool $withTld = true)
    {
        $this->withTld = $withTld;
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
        $validHostname = (bool) filter_var($value, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME);

        if (!$this->withTld) {
            return $validHostname;
        }

        $hostnameHasTld = (bool) preg_match('@\.(.*[A-Za-z])@', $value);

        return $validHostname && $hostnameHasTld;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field must be a valid hostname.';
    }
}