<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Profile
 *
 * @package App
 * @property string $firstname
 * @property string $lastname
 * @property string $dob
 * @property string $address
 * @property string $city
 * @property string $province
 * @property string $postalcode
 * @property string $phone
 * @property string $auth_user_fname
 * @property string $auth_user_lname
 * @property string $auth_user_phone
 * @property string $created_by
*/
class Profile extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['firstname', 'lastname', 'dob', 'city', 'province', 'postalcode', 'phone', 'auth_user_fname', 'auth_user_lname', 'auth_user_phone', 'address_address', 'address_latitude', 'address_longitude', 'created_by_id'];
    protected $hidden = [];
    public static $searchable = [
        'firstname',
        'address_address',
        'address_latitude',
        'address_longitude',
        'city',
        'postalcode',
        'auth_user_fname',
        'auth_user_lname',
    ];
    
    public static function boot()
    {
        parent::boot();

        Profile::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['firstname'] = ucfirst($value);
        $this->attributes['lastname'] = ucfirst($value);
        $this->attributes['city'] = ucfirst($value);
        $this->attributes['province'] = strtoupper($value);
        $this->attributes['postalcode'] = strtoupper($value);
        $this->attributes['auth_user_fname'] = ucfirst($value);
        $this->attributes['auth_user_lname'] = ucfirst($value);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDobAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['dob'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['dob'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDobAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

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
