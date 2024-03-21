<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use SoftDeletes;

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
     * Mutator for the ssn attribute.
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
                return [
                    'ssn' => Crypt::encryptString($value),
                    'ssn_last_four' => Str::substr($value, -4, 4),
                ];
            },
        );
    }
}
