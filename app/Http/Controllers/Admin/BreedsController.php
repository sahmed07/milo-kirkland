<?php

namespace App\Http\Controllers\Admin;

use App\Breed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBreedsRequest;
use App\Http\Requests\Admin\UpdateBreedsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class BreedsController extends Controller
{
    /**
     * Display a listing of Breed.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('breed_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Breed.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Breed.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('breed_delete')) {
                return abort(401);
            }
            $breeds = Breed::onlyTrashed()->get();
        } else {
            $breeds = Breed::all();
        }

        return view('admin.breeds.index', compact('breeds'));
    }

    /**
     * Show the form for creating new Breed.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('breed_create')) {
            return abort(401);
        }
        return view('admin.breeds.create');
    }

    /**
     * Store a newly created Breed in storage.
     *
     * @param  \App\Http\Requests\StoreBreedsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBreedsRequest $request)
    {
        if (! Gate::allows('breed_create')) {
            return abort(401);
        }
        $breed = Breed::create($request->all());



        return redirect()->route('admin.breeds.index');
    }


    /**
     * Show the form for editing Breed.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('breed_edit')) {
            return abort(401);
        }
        $breed = Breed::findOrFail($id);

        return view('admin.breeds.edit', compact('breed'));
    }

    /**
     * Update Breed in storage.
     *
     * @param  \App\Http\Requests\UpdateBreedsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBreedsRequest $request, $id)
    {
        if (! Gate::allows('breed_edit')) {
            return abort(401);
        }
        $breed = Breed::findOrFail($id);
        $breed->update($request->all());



        return redirect()->route('admin.breeds.index');
    }


    /**
     * Display Breed.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('breed_view')) {
            return abort(401);
        }
        $breed = Breed::findOrFail($id);

        return view('admin.breeds.show', compact('breed'));
    }


    /**
     * Remove Breed from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('breed_delete')) {
            return abort(401);
        }
        $breed = Breed::findOrFail($id);
        $breed->delete();

        return redirect()->route('admin.breeds.index');
    }

    /**
     * Delete all selected Breed at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('breed_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Breed::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Breed from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('breed_delete')) {
            return abort(401);
        }
        $breed = Breed::onlyTrashed()->findOrFail($id);
        $breed->restore();

        return redirect()->route('admin.breeds.index');
    }

    /**
     * Permanently delete Breed from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('breed_delete')) {
            return abort(401);
        }
        $breed = Breed::onlyTrashed()->findOrFail($id);
        $breed->forceDelete();

        return redirect()->route('admin.breeds.index');
    }
}
