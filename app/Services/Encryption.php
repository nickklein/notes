<?php

namespace notes\Services;

use Illuminate\Support\Facades\Crypt;

// Class that will be improved for other types of encryption
class Encryption
{
    public static function encrypt(string $value)
    {
        return Crypt::encrypt($value);
        // Will be extended for more stuff
    }
    public static function decrypt(string $value)
    {
        return Crypt::decrypt($value);
        // Will be extended for more stuff
    }
}