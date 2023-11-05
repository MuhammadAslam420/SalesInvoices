<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    protected $table="countries";
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
