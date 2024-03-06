<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\SubtotalScope;

class Subtotal extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new SubtotalScope);
    }
}