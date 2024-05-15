<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Distribuitor extends Model
{
    use HasFactory;
    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'distribuitor_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
