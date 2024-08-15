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

    //arreglo de los campos que deseo almacenar
    protected $fillable = ['user_id', 'quantity', 'status'];

    protected $casts = ['created_at' => 'datetime'];

    // un pedido pertenece a un usuario
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    //un pedido puede tener muchos productos
    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    /**
     * Esta funcion filtra los pedidos del usuario mostrando solo los que les pertenece a el.
     */
    public function scopeMyOrders(Builder $query) {
            $query->where('user_id', auth()->id());
    }
}

