<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function subscribe_process(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $id = Auth::id();//user_id取得
            $user = User::find($id);
            $user->newSubscription('main', 'plan_H8wx9zfkWIpG9B')->create($request->stripeToken);

            return back();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function subscribe_cancel(Request $request)//キャンセル用
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $id = Auth::id();//user_id取得
            $user = User::find($id);
//            すぐにキャンセル
            $user->subscription('main')->cancelNow();

            return 'Cancel successful';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

}
