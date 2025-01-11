<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    //Array of the fields I want to store
    protected $fillable = ['user_id', 'quantity', 'status'];

    protected $casts = ['created_at' => 'datetime'];

    // An order has one user
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    //An order has many products
    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    /**
     * This function filters the user's own order.
     */
    public function scopeMyOrders(Builder $query) {
            $query->where('user_id', auth()->id());
    }

    public function scopePendingOrders(Builder $query) {
        $query->where('status', 'pendiente');
    }
}

