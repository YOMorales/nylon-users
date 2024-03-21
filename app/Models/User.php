<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'ssn',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'ssn',
    ];

    /**
     * Mutator for the slug attribute.
     *
     * DEV NOTE: Laravel has a $casts attribute for encryption: https://laravel.com/docs/10.x/eloquent-mutators#encrypted-casting
     * However, I opted to manually encrypt the ssn because it's so crucial to do this, that I don't want to risk it by
     * having Laravel do it automatically.
     * Putting it here brings visibility of the encryption to the developers. And it also avoids
     * accidental/unwanted decryption (which might happen with the $casts attribute).
     */
    protected function ssn(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                return Crypt::encryptString($value);
            },
        );
    }
}
