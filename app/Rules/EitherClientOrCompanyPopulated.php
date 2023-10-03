<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EitherClientOrCompanyPopulated implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $client = request()->input('client_id');
        $company = request()->input('company_id');

        if (empty($client) && empty($company)) {
            $fail('Either client or company must be populated.');
        }
    }
}
