<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Investment;
use App\Models\Page;
use App\Models\Plan;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function plan()
    {
        $pageTitle = "Plans";
        $emptyMessage = "No Plan Yet";
        $plans  = Plan::where('status', 1)->with('intervel')->latest()->get();
        return view($this->activeTemplate . 'plan', compact('pageTitle', 'emptyMessage', 'plans'));
    }

    public function investmentPlan(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $request->validate([
            'payment_method'    => 'required|in:deposit,interest,direct',
            'amount'            => 'required|numeric'
        ]);
        $maximumLimit = $plan->maximum_investment;

        if ($plan->minimum_investment == 0) {
            $amount         = $plan->maximum_investment;
            $minimumLimit   = $plan->maximum_investment;
        } else {
            $amount         = $request->amount;
            $minimumLimit   = $plan->minimum_investment;
        }

        if ($amount < $minimumLimit && $amount > $maximumLimit) {
            $notify[] = ['error', 'Please follow the limit'];
            return back()->withNotify($notify);
        }

        $session = session()->put('checkout',[
            'amount'=>$amount,
            'plan'=>$plan
        ]);

        if ($request->payment_method == 'direct') {
            return redirect()->route('user.deposit');
        }


        if ($request->payment_method == 'deposit') {
            $wallet = 'balance';
        } else {
            $wallet = 'interest_wallet';
        }

        $user = auth()->user();
        $user->$wallet -= $amount;
        $user->save();
        $general = GeneralSetting::first();
        $transaction            = new Transaction();
        $transaction->user_id   = $user->id;
        $transaction->amount    =  $general->cur_sym . showAmount($amount);
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '-';
        $transaction->details = 'Invested a new plan';
        $transaction->trx =  getTrx();
        $transaction->save();

        $investment = new Investment();
        $investment->user_id = $user->id;
        $investment->plan_id = $plan->id;
        $investment->amount = $request->amount;
        $investment->interest  = $plan->interest_status == 0 ? $plan->interest :  $amount * $plan->interest / 100;
        $investment->times  = $plan->times;
        $investment->next_time  = Carbon::now()->addHours($investment->times);
        $investment->last_update_time  = Carbon::now();
        $investment->capital_back  = $plan->capital_back;
        $investment->repeat_time  = $plan->repeat_time;
        $investment->details = $user->username . ' invested  ' . $plan->name . ' plan';
        $investment->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'Invested ' . $plan->name . ' plan by ' . $user->username;
        $adminNotification->click_url = urlPath('admin.plan.investment.details', $investment->id);
        $adminNotification->save();
        $notify[] = ['success', 'Successfully invested'];
        return redirect()->route('user.invested.plans')->withNotify($notify);
    }

    public function investedPlanList()
    {
        $pageTitle = "My Plans";
        $emptyMessage = "No Plan Yet";
        $investedPlans  = Investment::where('user_id', auth()->user()->id)->with('plan', 'intervel')->orderBy('id', 'DESC')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.plan.invested_plan_list', compact('pageTitle', 'emptyMessage', 'investedPlans'));
    }
}
