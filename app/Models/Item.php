<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'description'];

    public function scopeAllowed($query)
    {
        return $query->where('status', 'Allowed');
    }
}
