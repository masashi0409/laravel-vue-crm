<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'kana',
        'tel',
        'email',
        'postcode',
        'address',
        'birthday',
        'gender',
        'memo',
    ];
    
    /**
     * 氏名またはカナまたは電話番号で部分一致検索
     */
    public function scopeSearchCustomers($query, $input = null)
    {
        if (!empty($input)) {
            return $query
                    ->where('name', 'like', '%' . $input . '%')
                    ->orWhere('kana', 'like', '%' . $input . '%') 
                    ->orWhere('tel', 'like', '%' . $input . '%');
        }
    }
    
    /**
     * 顧客と購入履歴は1体多
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
