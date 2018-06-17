<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Breed
 *
 * @package App
 * @property string $breed_title
*/
class Breed extends Model
{
    //use SoftDeletes, FilterByUser;

    protected $fillable = ['breed_title'];
    protected $hidden = [];
    public static $searchable = [
        'breed_title',
    ];
    
    public static function boot()
    {
        parent::boot();

        Breed::observe(new \App\Observers\UserActionsObserver);
    }
    
}
