<?php

namespace notes\Src;

use Illuminate\Support\Facades\Crypt;

class NotesHelper
{
    public static function fetchCaption(string $data)
    {
        
        return substr(strip_tags($data), 0, 60) . '..';
    }

    public static function encrypt(string $value)
    {
        // Regular Encryption
        return Crypt::encrypt($value);

        // Custom Key Encryption
    }
    
    public static function decrypt(string $value)
    {
        // Regular Decryption
        return Crypt::decrypt($value);

        // Custom Key Decryption
    }
}
