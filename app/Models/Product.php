<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'company_id',
        'name',
        'color',
        'code',
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }


    public function producers(): BelongsToMany
    {
        return $this->belongsToMany(Producer::class);
    }
}
