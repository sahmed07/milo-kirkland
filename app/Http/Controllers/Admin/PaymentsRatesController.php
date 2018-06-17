<?php

namespace App\Http\Controllers\Admin;

use App\PaymentsRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePaymentsRatesRequest;
use App\Http\Requests\Admin\UpdatePaymentsRatesRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PaymentsRatesController extends Controller
{
    /**
     * Display a listing of PaymentsRate.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('payments_rate_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('PaymentsRate.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('PaymentsRate.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('payments_rate_delete')) {
                return abort(401);
            }
            $payments_rates = PaymentsRate::onlyTrashed()->get();
        } else {
            $payments_rates = PaymentsRate::all();
        }

        return view('admin.payments_rates.index', compact('payments_rates'));
    }

    /**
     * Show the form for creating new PaymentsRate.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('payments_rate_create')) {
            return abort(401);
        }
        return view('admin.payments_rates.create');
    }

    /**
     * Store a newly created PaymentsRate in storage.
     *
     * @param  \App\Http\Requests\StorePaymentsRatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentsRatesRequest $request)
    {
        if (! Gate::allows('payments_rate_create')) {
            return abort(401);
        }
        $payments_rate = PaymentsRate::create($request->all());



        return redirect()->route('admin.payments_rates.index');
    }


    /**
     * Show the form for editing PaymentsRate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('payments_rate_edit')) {
            return abort(401);
        }
        $payments_rate = PaymentsRate::findOrFail($id);

        return view('admin.payments_rates.edit', compact('payments_rate'));
    }

    /**
     * Update PaymentsRate in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentsRatesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentsRatesRequest $request, $id)
    {
        if (! Gate::allows('payments_rate_edit')) {
            return abort(401);
        }
        $payments_rate = PaymentsRate::findOrFail($id);
        $payments_rate->update($request->all());



        return redirect()->route('admin.payments_rates.index');
    }


    /**
     * Display PaymentsRate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('payments_rate_view')) {
            return abort(401);
        }
        $payments_rate = PaymentsRate::findOrFail($id);

        return view('admin.payments_rates.show', compact('payments_rate'));
    }


    /**
     * Remove PaymentsRate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('payments_rate_delete')) {
            return abort(401);
        }
        $payments_rate = PaymentsRate::findOrFail($id);
        $payments_rate->delete();

        return redirect()->route('admin.payments_rates.index');
    }

    /**
     * Delete all selected PaymentsRate at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('payments_rate_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PaymentsRate::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore PaymentsRate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('payments_rate_delete')) {
            return abort(401);
        }
        $payments_rate = PaymentsRate::onlyTrashed()->findOrFail($id);
        $payments_rate->restore();

        return redirect()->route('admin.payments_rates.index');
    }

    /**
     * Permanently delete PaymentsRate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('payments_rate_delete')) {
            return abort(401);
        }
        $payments_rate = PaymentsRate::onlyTrashed()->findOrFail($id);
        $payments_rate->forceDelete();

        return redirect()->route('admin.payments_rates.index');
    }
}
