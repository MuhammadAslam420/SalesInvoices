<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'saleId');
    }
    public static function search($search, $date, $sorting, $size)
    {
        $query = Transaction::query();

        if ($search) {
            $query->where('ptype', 'like', "$search%")
                ->orWhereHas('sale', function (Builder $query) use ($search) {
                    $query->where('saleId', 'like', "%$search%");
                });
        }

        if ($date) {
            $query->orWhere('created_at', 'like', "%$date%");
        }

        if ($sorting === 'ptype_asc') {
            $query->orderBy('ptype', 'asc');
        } elseif ($sorting === 'ptype_desc') {
            $query->orderBy('ptype', 'desc');
        } elseif ($sorting === 'created_at_asc') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sorting === 'created_at_desc') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sorting === 'saleId_asc') {
            $query->orderBy('saleId', 'asc');
        } elseif ($sorting === 'saleId_desc') {
            $query->orderBy('saleId', 'desc');
        } else {
            // Default sorting by id in descending order
            $query->orderBy('id', 'desc');
        }

        return $query->paginate($size);
    }


}
