<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Pet
 *
 * @package App
 * @property string $tag_id
 * @property string $pet_photo
 * @property string $pet_name
 * @property string $pet_type
 * @property string $pet_breed
 * @property string $pet_color
 * @property string $pet_age
 * @property string $pet_sex
 * @property string $behaviour
 * @property string $pet_size
 * @property string $distinctive_sign
 * @property enum $microchip
 * @property string $sprayed_neutered
 * @property enum $rabies_vacc
 * @property enum $pet_status
 * @property enum $pay_status
 * @property string $created_by
*/
class Pet extends Model implements HasMedia
{
    use SoftDeletes, FilterByUser, HasMediaTrait;

    protected $fillable = ['tag_id', 'pet_photo', 'pet_name', 'pet_type', 'pet_breed', 'pet_color', 'pet_age', 'pet_sex', 'behaviour', 'pet_size', 'distinctive_sign', 'microchip', 'sprayed_neutered', 'rabies_vacc', 'pet_status', 'pay_status', 'created_by_id'];
    protected $hidden = [];
    public static $searchable = [
        'tag_id',
        'pet_name',
        'pet_type',
        'pet_color',
        'pet_sex',
        'behaviour',
        'pet_size',
        'distinctive_sign',
        'microchip_file',
        'sprayed_neutered',
        'rabies_vacc',
        'pay_status',
    ];
    
    public static function boot()
    {
        parent::boot();
        /*
        static::creating(function($model) {
            $model->tag_id = str_pad($model->getKey(), (6), '0', STR_PAD_LEFT);
        }); */

        Pet::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_microchip = ["Yes" => "Yes", "No" => "No"];

    public static $enum_rabies_vacc = ["Yes" => "Yes", "No" => "No"];

    public static $enum_pet_status = ["Active" => "Active", "Deceased" => "Deceased", "Lost" => "Lost"];

    public static $enum_pay_status = ["Paid" => "Paid", "Unpaid" => "Unpaid"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
}
