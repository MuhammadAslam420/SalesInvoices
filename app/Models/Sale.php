<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use DB;

class Sale extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public static function search($keyword, $country, $date, $sorting, $size)
    {
        $query = Sale::query();

        if ($keyword) {
            $query->where('saleId', 'like', "%$keyword%")
                ->orWhere('status','like',"%$keyword%")
                ->orWhereHas('customer', function (Builder $query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                });
        }

        if ($country) {
            // Filter sales based on customer_id where customer's country_id matches the given country name
            $customerIds = Customer::whereHas('country', function ($query) use ($country) {
                $query->where('id', 'like', "%$country%");
            })->pluck('id');
            $query->whereIn('customer_id', $customerIds);
        }

        if ($date) {
            $formattedDate = Carbon::parse($date)->format('Y-m-d');
            $query->whereDate('created_at', $formattedDate);
        }

        // Handle sorting
        if ($sorting === 'asc' || $sorting === 'desc') {
            // Default sorting by created_at
            $query->orderBy('sales.created_at', $sorting);
        } else {
            // Assuming $sorting contains the column name for sorting
            if ($sorting === 'country_id') {
                // Sort by country_id using a raw SQL expression
                $query->orderBy(DB::raw('(SELECT country_id FROM customers WHERE customers.id = sales.customer_id)'), $sorting);
            }
            // Add more conditions for other columns if needed
        }

        return $query->paginate($size);
    }

   public function transactions()
   {
    return $this->hasMany(Transaction::class, 'saleId');
   }

}
