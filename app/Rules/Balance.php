<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Balance implements Rule
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
        $debit = 0;
        $credit = 0;
        foreach ($value as $line) {
            $debit = $debit + ($line['debit'] ?? 0);
            $credit = $credit + ($line['credit'] ?? 0);
        }
        return $debit === $credit;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The lines are not balanced.';
    }
}
