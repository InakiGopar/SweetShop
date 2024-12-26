<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    //arreglo de los campos que deseo almacenar
    protected $fillable = ['name', 'price', 'ingredients', 'description', 'image_path' ,'is_sweet'];

    //un producto puede tener muchos pedidos
    public function orders(): BelongsToMany {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function scopeSweetProducts(Builder $query) {
        $query->where('is_sweet', true);
    }

    public function scopeSaltyProducts(Builder $query) {
        $query->where('is_sweet', false);
    }

}
