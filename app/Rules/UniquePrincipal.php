<?php

namespace App\Rules;

use App\Models\Store;
use Illuminate\Contracts\Validation\Rule;

class UniquePrincipal implements Rule
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
        return $value == 0 ? true : !Store::where('is_principal', true)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya éxite una tienda principal.';
    }
}
