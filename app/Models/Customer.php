<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $fillable = [
        'country_id',
        'name', 'email', 'address', 'contact_number', 'picture',
    ];
    public function transactions()
    {
        return $this->hasMany(Cash::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public static function search($keyword, $size)
    {
        return Customer::where('name', 'like', "%$keyword%")
            ->orWhere('email', 'like', "%$keyword%")
            ->orWhere('contact_number', 'like', "%$keyword%")
            ->orWhere('address', 'like', "%$keyword%")
            ->orWhere('created_at', 'like', "%$keyword%")
            ->paginate($size);
    }
}
