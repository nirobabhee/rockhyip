<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Transaction;
use Carbon\Carbon;

class CronController extends Controller
{
    public function roiCalculation()
    {
        $investments = Investment::with('plan', 'user')->whereHas('user',  function ($q) {
            $q->where('status', 1);
        })
            ->where('status', 1)->where('next_time', '<', Carbon::now())
            ->where('last_update_time', '<', Carbon::now())->get();
        foreach ($investments as $investment) {
            $trx = getTrx();
            $investment->receive_return     += 1;
            if ($investment->receive_return == $investment->repeat_time) {
                $investment->status = 0;
                if ($investment->capital_back == 1) {
                    $investment->user->balance +=  $investment->amount;
                    $transaction                = new Transaction();
                    $transaction->user_id       = $investment->user->id;
                    $transaction->amount        = $investment->amount;
                    $transaction->charge        = 0;
                    $transaction->post_balance  = $investment->user->balance;
                    $transaction->trx_type      = '+';
                    $transaction->trx           = $trx;
                    $transaction->details       = 'Successfully ' . $investment->plan->name . 'plan capital back.';
                    $transaction->save();
                }
            }
            $investment->next_time          = Carbon::now()->addHours($investment->times);
            $investment->last_update_time   = Carbon::now();
            $investment->user->interest_wallet += $investment->interest;
            $investment->save();
            $investment->user->save();
            //ROI-Transaction
            $transaction                = new Transaction();
            $transaction->user_id       = $investment->user->id;
            $transaction->amount        = $investment->interest;
            $transaction->charge        = 0;
            $transaction->post_balance  = $investment->user->interest_wallet;
            $transaction->trx_type      = '+';
            $transaction->trx           = $trx;
            $transaction->details       = 'Successfully ' . $investment->plan->name . 'plan interest added.';
            $transaction->save();
            //Multiple-ref
            $referral = $investment->user;
            if ($referral->ref_by) {
                referralLevel($referral, 2, $investment, $investment->user, $trx);
            }
            //End-Multiple-ref
            notify($investment->user, 'INVESTMENT_INTEREST', [
                'receive_return' =>  $investment->receive_return,
                'plan_name' =>  $investment->plan->name,
                'update_at' =>  $investment->next_time,
            ]);
            // }
        }
    }
}
