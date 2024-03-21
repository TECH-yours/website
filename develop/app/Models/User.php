<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'members';

    protected $fillable = ['name', 'picture', 'email', 'role', 'phone', 'birthday', 'vat'];

    // Implementing methods from Authenticatable interface

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
        // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }

    // User.php

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class)->withPivot('usage_date');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
