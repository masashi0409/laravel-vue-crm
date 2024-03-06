<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Item;

class Purchase extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'status',
    ];
    
    /**
     * 顧客と購入履歴は1体多
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    /**
     * 中間テーブル 多対多リレーション
     */
    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('quantity');
    }
     

}
