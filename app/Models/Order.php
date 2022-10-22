<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_status_id' , 'table_number' , 'restaurant_id'];

    public function menuItems(): BelongsToMany
    {
        return $this->belongsToMany(MenuItem::class)->withPivot('quantity');
    }
}
