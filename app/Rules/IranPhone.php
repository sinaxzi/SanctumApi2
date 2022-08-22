<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class IranPhone implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if(substr($value,0,3) !== '989'){
            $fail('. :attribute باید با اعداد 989 شروع شود');
        }

        if(strlen($value) !== 12){
            $fail('. :attribute باید 12 رقم داشته باشد');
        }
    }
}
