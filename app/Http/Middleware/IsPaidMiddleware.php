<?php

namespace App\Http\Middleware;

use App\Models\Payment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsPaidMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $payment = Payment::where('user_id', Auth::id())
        ->where('payment_id', '!=', '')->where('status', '=', 'COMPLETED')
        // ->where('plan_id', '=', $request->plan)
        ->latest()->first();
        if(!$payment)
        {
            // return redirect()->route('goToPayment', ['plan' => $request->plan]);
            return redirect('/home')->with('error', 'Please make payment first');
        }
        return $next($request);
    }
}
