<?php

namespace App\Http\Controllers;

use App\User;
use App\Pet;
use App\Profile;
use Validator;
use Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
//use App\Http\Requests\Admin\StorePetsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class RegistrationController extends Controller
{
    use FileUploadTrait;    
    /**
     * Show the Form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function createUser(Request $request)
    {
        $user = $request->session()->get('user');
        return view('auth.createUser',compact('user', $user));
    }

    /**
     * Post Request to store user info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function postCreateUser(Request $request)
    {

        $validatedData = $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if(empty($request->session()->get('user'))){
            $user = new User();
            $user->fill($validatedData);            
            $request->session()->put('user', $user);
        }else{
            $user = $request->session()->get('user');
            $user->fill($validatedData);            
            $request->session()->put('user', $user);
        }

        return redirect('/auth/createProfile');

    }
/*
    $dt = new Carbon\Carbon();
    $before = $dt->subYears(16)->format('Y-m-d');
*/
    /**
     * Show the next Form for creating a user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProfile(Request $request)
    {
        $profile = $request->session()->get('profile');
        return view('auth.createProfile',compact('profile', $profile));
    }        

    /**
     * Post Request to store profile info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateProfile(Request $request)
    {
        switch($request->submitbutton) {

            case trans('global.app_addPetNow'):

                $validatedData = $request->validate([
                    'firstname'     => 'required|max:255',
                    'lastname'     => 'required|max:255',
                    'dob'    => 'required|date|before:-16 years',            
                ]);
        
                if(empty($request->session()->get('profile'))){
                    $profile = new Profile();
                    $profile->fill($validatedData);
                    $request->session()->put('profile', $profile);
                }else{
                    $profile = $request->session()->get('profile');
                    $profile->fill($validatedData);
                    $request->session()->put('profile', $profile);
                }
        
                return redirect('/auth/reviewUser');

            break;
        
            case trans('global.app_addPetLater'):

                $validatedData = $request->validate([
                    'firstname'     => 'required|max:255',
                    'lastname'     => 'required|max:255',
                    'dob'    => 'required|date|before:-16 years',            
                ]);
        
                if(empty($request->session()->get('profile'))){
                    $profile = new Profile();
                    $profile->fill($validatedData);
                    $request->session()->put('profile', $profile);
                }else{
                    $profile = $request->session()->get('profile');
                    $profile->fill($validatedData);
                    $request->session()->put('profile', $profile);
                }

                $profile = $request->session()->get('profile');                        
                $profile->save();
                                
                $request->session()->flash('profile', $request->profile);
        
                return redirect('/afterRegister');

            break;
        }        

    }

    /**
     * Show the user profile review page
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /*$user = $request->session()->get('user');
        $profile = $request->session()->get('profile'); */
    
        /*
        static::creating(function($model) {
            $model->tag_id = str_pad($model->getKey(), ('KR'+6), '0', STR_PAD_LEFT);
        });*/

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_microchip = \App\Pet::$enum_microchip;
                    $enum_rabies_vacc = Pet::$enum_rabies_vacc;
                    $enum_pet_status = Pet::$enum_pet_status;
                    $enum_pay_status = Pet::$enum_pay_status;
        
                    $breed = \App\Breed::get()->pluck('breed_title','breed_title')->prepend(trans('global.app_please_select'), '');                    

        return view('auth.reviewUser', compact('breed', 'enum_microchip', 'enum_rabies_vacc', 'enum_pet_status', 'enum_pay_status', 'created_bies'));
        //return view('auth.reviewUser',compact('user',$user,'profile',$profile));
    }

    /**
     * Store user and profile
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->session()->get('user');
        /*
        $user = User::create($user);
        $id = $user->id;
        */
/*
        //user registration
        $user->save();        
        $id = $user->id;
        $user->role()->attach(config('app_service.default_role_id'));
*/
        //user profile
    //    $user = new User();
    //    $id = $user->id;
        $profile = $request->session()->get('profile');  
    //    $profile->created_by_id = $id;              
        $profile->save();
        
        $request->session()->flash('user', $request->user);
        $request->session()->flash('profile', $request->profile);

        //pet registration
        $request = $this->saveFiles($request);
        $pet = Pet::create($request->all());        

        //add tag_id based on id
        $tag = str_pad($pet->id, 6, '0', STR_PAD_LEFT);
        $pet->tag_id= 'KR'.$tag;
        $pet->save();

        foreach ($request->input('microchip_file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $pet->id;
            $file->save();
        }
        foreach ($request->input('rabies_vacc_file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $pet->id;
            $file->save();
        }            

        return redirect('/afterRegister');
    }
    
}
