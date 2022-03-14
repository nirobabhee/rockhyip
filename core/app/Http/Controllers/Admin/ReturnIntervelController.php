<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReturnIntervel;
use Illuminate\Http\Request;

class ReturnIntervelController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Return Intervel";
        $emptyMessage = 'No Data Create Yet.';
        $returnIntervels = ReturnIntervel::latest()->paginate(getPaginate());
        return view('admin.return_intervel', compact('pageTitle', 'emptyMessage', 'returnIntervels'));
    }
    public function Store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:40|unique:return_intervels,name',
                'intervel' => 'bail|required|numeric|gt:0|unique:return_intervels,intervel',
            ]
        );
        $returnIntervel = new ReturnIntervel();
        $returnIntervel->name = $request->name;
        $returnIntervel->intervel = $request->intervel;
        $returnIntervel->save();
        $notify[] = ['success', $returnIntervel->name . ' return intervel successfully added.'];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {
        $returnIntervel = ReturnIntervel::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:40',
            'intervel' => 'bail|required|numeric|gt:0|unique:return_intervels,intervel,' . $id, //except this id//
        ]);
        $returnIntervel->name = $request->name;
        $returnIntervel->intervel = $request->intervel;
        $returnIntervel->save();
        $notify[] = ['success', $returnIntervel->name . ' return intervel successfully updated.'];
        return back()->withNotify($notify);
    }
}
