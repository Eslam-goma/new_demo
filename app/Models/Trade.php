<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'open_at',
        'closed_at',
        'asset',
        'amount',
        'qty',
        'pnl',
        'opening_price',
        'current_price',
        'direction',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAmountAttribute($value)
    {
        return number_format($value, 2);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = round($value, 2);
    }

    public function calculatePnl()
    {
        if ($this->direction === 'buy') {
            return ($this->current_price - $this->opening_price) * $this->qty;
        } else {
            return ($this->opening_price - $this->current_price) * $this->qty;
        }
    }
}
