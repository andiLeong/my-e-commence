<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class UpdateProductImageCantGreaterThanOrigin implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param $originCount
     */
    public function __construct(protected  $originCount)
    {

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
        return sizeof($value) + $this->originCount <= 3;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Product Images Cant greater than three total.';
    }
}
