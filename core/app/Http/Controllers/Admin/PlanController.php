<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Plan;
use App\Models\ReturnIntervel;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Plan";
        $emptyMessage = 'No Data Create Yet.';
        $plans = Plan::latest()->with('intervel')->paginate(getPaginate());
        return view('admin.plan.index', compact('pageTitle', 'emptyMessage', 'plans'));
    }
    public function create()
    {
        $pageTitle = "Manage Plan";
        $intervals = ReturnIntervel::get();
        return view('admin.plan.create', compact('pageTitle', 'intervals'));
    }
    protected function validation($request, $id = 0)
    {
        $request->validate(
            [
                'name' => 'required|string|max:40|unique:plans,name,' . $id,
                'interest_status' => 'bail|required',
                'interest' => 'bail|required',
                'amount_type' => 'bail|required',
                'fixed_investment' => 'bail|nullable|required_if:amount_type,fixed|numeric|gt:0',
                'minimum_investment' => 'bail|nullable|required_if:amount_type,range|numeric|gt:0',
                'maximum_investment' => 'bail|nullable|required_if:amount_type,range|numeric|gt:minimum_investment',
                'time_status' => 'bail|required',
                'repeat_time' => 'nullable|required_if:time_status,periodical|numeric|gt:0'

            ]
        );
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $intervel = ReturnIntervel::where('intervel', $request->times)->first();
        if (!$intervel) {
            $notify[] = ['error', 'Times of Return intervel is invalid'];
            return back()->withNotify($notify);
        }
        $plan = new Plan();
        $plan->name = $request->name;
        if ($request->amount_type == 'fixed') {
            $plan->maximum_investment = $request->fixed_investment ?? 0; //fixed
        } else {
            $plan->minimum_investment = $request->minimum_investment ?? 0; //min
            $plan->maximum_investment = $request->maximum_investment ?? 0; //max
        }
        $plan->interest_status =  ($request->interest_status == '%') ? 1 : 0;
        $plan->interest = $request->interest;
        $plan->times = $request->times;
        $plan->capital_back = $request->capital_back == 'on' ? 1 : 0;
        $plan->status = 1;
        $plan->repeat_time = $request->repeat_time ?? 0;
        $plan->save();
        $notify[] = ['success', $plan->name . ' plan successfully added'];
        return redirect()->route('admin.plan.list')->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle = "Edit Plan";
        $plan = Plan::where('id', $id)->firstOrFail();
        $intervals = ReturnIntervel::get();
        return view('admin.plan.edit', compact('pageTitle', 'plan', 'intervals'));
    }

    
    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $this->validation($request, $id);
        $plan->name = $request->name;
        if ($request->amount_type == 'fixed') {
            $plan->maximum_investment = $request->fixed_investment ?? 0; //fixed
        } else {
            $plan->minimum_investment = $request->minimum_investment ?? 0; //min
            $plan->maximum_investment = $request->maximum_investment ?? 0; //max
        }
        $plan->interest_status =  ($request->interest_status == '%') ? 1 : 0;
        $plan->interest = $request->interest;
        $plan->times = $request->times;
        $plan->capital_back = $request->capital_back == 'on' ? 1 : 0;
        $plan->status = 1;
        $plan->repeat_time = $request->repeat_time ?? 0;
        $plan->save();
        $notify[] = ['success', $plan->name . ' plan successfully Updated'];
        return redirect()->route('admin.plan.list')->withNotify($notify);
    }

    public function investmentList()
    {
        $pageTitle = "Invested Plans";
        $emptyMessage = 'No Investment Yet.';
        $investments = Investment::with('plan', 'user')->latest()->paginate(getPaginate());
        return view('admin.investment.index', compact('pageTitle', 'emptyMessage', 'investments'));
    }
}
