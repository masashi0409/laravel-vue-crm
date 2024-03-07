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
    
    public function scopeBetweenDate($query, $startDate = null, $endDate = null)
     {
        if(is_null($startDate) && is_null($endDate))
        { 
            return $query;
        }
        
        if(!is_null($startDate) && is_null($endDate))
        {
            return $query->where('created_at', ">=", $startDate);
        }
        
        if(is_null($startDate) && !is_null($endDate))
        {
            return $query->where('created_at', '<=', $endDate);
        }
        
        if(!is_null($startDate) && !is_null($endDate))
        {
            return $query->where('created_at', ">=", $startDate)->where('created_at', '<=', $endDate);
        }
 }
}