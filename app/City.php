<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City
 *
 * @package App
 * @property string $city_name
*/
class City extends Model
{
    use SoftDeletes;

    protected $fillable = ['city_name'];
    protected $hidden = [];
    public static $searchable = [
        'city_name',
    ];
    
    public static function boot()
    {
        parent::boot();

        City::observe(new \App\Observers\UserActionsObserver);
    }
    
}
