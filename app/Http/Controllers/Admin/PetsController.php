<?php

namespace App\Http\Controllers\Admin;

use App\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePetsRequest;
use App\Http\Requests\Admin\UpdatePetsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class PetsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Pet.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('pet_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Pet.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Pet.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('pet_delete')) {
                return abort(401);
            }
            $pets = Pet::onlyTrashed()->get();
        } else {
            $pets = Pet::all();
        }

        return view('admin.pets.index', compact('pets'));
    }

    /**
     * Show the form for creating new Pet.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('pet_create')) {
            return abort(401);
        }
        /*
        static::creating(function($model) {
            $model->tag_id = str_pad($model->getKey(), ('KR'+6), '0', STR_PAD_LEFT);
        });*/

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_microchip = Pet::$enum_microchip;
                    $enum_rabies_vacc = Pet::$enum_rabies_vacc;
                    $enum_pet_status = Pet::$enum_pet_status;
                    $enum_pay_status = Pet::$enum_pay_status;
        
                    $breed = \App\Breed::get()->pluck('breed_title','breed_title')->prepend(trans('global.app_please_select'), '');

        return view('admin.pets.create', compact('breed', 'enum_microchip', 'enum_rabies_vacc', 'enum_pet_status', 'enum_pay_status', 'created_bies'));
    }

    /**
     * Store a newly created Pet in storage.
     *
     * @param  \App\Http\Requests\StorePetsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePetsRequest $request)
    {
        if (! Gate::allows('pet_create')) {
            return abort(401);
        }
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

        return redirect()->route('admin.pets.index');
    }


    /**
     * Show the form for editing Pet.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('pet_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_microchip = Pet::$enum_microchip;
                    $enum_rabies_vacc = Pet::$enum_rabies_vacc;
                    $enum_pet_status = Pet::$enum_pet_status;
                    $enum_pay_status = Pet::$enum_pay_status;
        
                    $breed = \App\Breed::get()->pluck('breed_title','breed_title')->prepend(trans('global.app_please_select'), '');

        $pet = Pet::findOrFail($id);

        return view('admin.pets.edit', compact('pet', 'breed', 'enum_microchip', 'enum_rabies_vacc', 'enum_pet_status', 'enum_pay_status', 'created_bies'));
    }

    /**
     * Update Pet in storage.
     *
     * @param  \App\Http\Requests\UpdatePetsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePetsRequest $request, $id)
    {
        if (! Gate::allows('pet_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $pet = Pet::findOrFail($id);
        $pet->update($request->all());


        $media = [];
        foreach ($request->input('microchip_file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $pet->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $pet->updateMedia($media, 'microchip_file');
        $media = [];
        foreach ($request->input('rabies_vacc_file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $pet->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $pet->updateMedia($media, 'rabies_vacc_file');

        return redirect()->route('admin.pets.index');
    }


    /**
     * Display Pet.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('pet_view')) {
            return abort(401);
        }
        $pet = Pet::findOrFail($id);

        return view('admin.pets.show', compact('pet'));
    }


    /**
     * Remove Pet from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('pet_delete')) {
            return abort(401);
        }
        $pet = Pet::findOrFail($id);
        $pet->deletePreservingMedia();

        return redirect()->route('admin.pets.index');
    }

    /**
     * Delete all selected Pet at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('pet_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Pet::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Pet from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('pet_delete')) {
            return abort(401);
        }
        $pet = Pet::onlyTrashed()->findOrFail($id);
        $pet->restore();

        return redirect()->route('admin.pets.index');
    }

    /**
     * Permanently delete Pet from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('pet_delete')) {
            return abort(401);
        }
        $pet = Pet::onlyTrashed()->findOrFail($id);
        $pet->forceDelete();

        return redirect()->route('admin.pets.index');
    }
}
