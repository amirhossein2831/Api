<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    public $fillable =[
      'name',
      'country',
      'number',
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
