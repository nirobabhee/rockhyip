<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralLevel;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Referral";
        $commissions = ReferralLevel::get();
        return view('admin.referral.index', compact('pageTitle', 'commissions'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'type' => 'required|numeric',
                'level_number' => 'required|numeric',
                'commissions' => 'required|array',
                'commissions.*' => 'numeric',

            ]
        );
        ReferralLevel::where('type', $request->type)->delete();
        foreach ($request->commissions as $key => $commission) {
            $referralLevel = new ReferralLevel();
            $referralLevel->level = $key + 1;
            $referralLevel->type = $request->type;
            $referralLevel->percent = $commission;
            $referralLevel->save();
        }
        $notify[] = ['success', 'Referral level created successfully.'];
        return back()->withNotify($notify);
    }
}
