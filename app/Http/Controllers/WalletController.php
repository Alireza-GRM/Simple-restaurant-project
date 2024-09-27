<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function walletCharg(Request $request)
    {
        $request->validate([
            'PriceCharg' => 'required'
        ]);

        $Charg = $request->input('PriceCharg');
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
    
        if ($wallet) {
            $wallet->update([
                'Price' => $wallet->Price + $Charg
            ]);
        } else {
            Wallet::create([
                'user_id' => Auth::user()->id,
                'Price' => $Charg
            ]);
        }
    
        return redirect(route('home'));
    }
}
