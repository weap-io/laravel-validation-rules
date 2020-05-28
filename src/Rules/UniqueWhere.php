<?php

namespace Weap\LaravelValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueWhere implements Rule
{
    protected $uniqueTableAndColumn = '';

    protected $whereConditions = [];

    public function __construct(string $uniqueTableAndColumn, array $whereConditions)
    {
        $this->uniqueTableAndColumn = $uniqueTableAndColumn;
        $this->whereConditions = $whereConditions;
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
        list($table, $column) = explode('.', $this->uniqueTableAndColumn);

        if (!$table || !$column) {
            return false;
        }
        
        $query = \DB::table($table)->where($column, $value);

        foreach ($this->whereConditions as $conditionColumn => $conditionValue) {
            $query->where($conditionColumn, $conditionValue);
        }
        
        return $query->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be uppercase.';
    }
}
