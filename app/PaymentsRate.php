<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class PaymentsRate
 *
 * @package App
 * @property string $payment_type
 * @property decimal $amount
*/
class PaymentsRate extends Model
{
   // use SoftDeletes, FilterByUser;

    protected $fillable = ['payment_type', 'amount'];
    protected $hidden = [];
    public static $searchable = [
        'payment_type',
    ];
    
    public static function boot()
    {
        parent::boot();

        PaymentsRate::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setAmountAttribute($input)
    {
        $this->attributes['amount'] = $input ? $input : null;
    }
    
}
