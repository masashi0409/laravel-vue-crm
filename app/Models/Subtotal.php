<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\SubtotalScope;
use Carbon\Carbon; // Laravelで日付を扱うライブラリ

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
            $endDate1 = Carbon::parse($endDate)->addDays(1); // endDateがそのままだとその日を含んでいないので、1日足す。 Carbon::parse() 文字列を日付で扱える
            return $query->where('created_at', '<=', $endDate1);
        }
        
        if(!is_null($startDate) && !is_null($endDate))
        {
            $endDate1 = Carbon::parse($endDate)->addDays(1);
            return $query->where('created_at', ">=", $startDate)->where('created_at', '<=', $endDate1);
        }
 }
}