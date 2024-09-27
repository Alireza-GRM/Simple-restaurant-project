<?php

namespace App\Http\Controllers;

use App\Models\ProductBasket;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class basketController extends Controller
{
    public function Add($product_id , $restaurant_id)
    {
        $productbasket = ProductBasket::
        where('user_id' , '=' , Auth::user()->id)
        ->where('product_id' , '=' , $product_id)
        ->where('restaurant_id' , '=' , $restaurant_id)
        ->where('Status_Paying' , '=' , 0)
        ->first();
        if ($productbasket)
        {
            $productbasket->update([
                'Counte' => $productbasket->Counte + 1
            ]);
        }
        else
        {
            ProductBasket::create([
                'product_id' => $product_id,
                'restaurant_id' => $restaurant_id,
                'Counte' => 1,
                'user_id' => Auth::user()->id
            ]);
        }

        return redirect()->back();
    }

    public function Delete($id)
    {
        $basket = ProductBasket::where('user_id' , '=' , Auth::user()->id)
        ->where('id' , '=' , $id)
        ->where('Status_Paying' , '=' , 0)
        ->first();

        if ($basket)
        {
            $basket->delete();
        }
        else
        {
            return redirect()->back()->with('message2' , 'موردی یافت نشد !');
        }

        return redirect()->back();
    }

    public function ShowBasket($user_id)
    {
        $productbasket = ProductBasket::where('user_id' , '=' , $user_id)->where('Status_Paying' , '=' , 0)->get();
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        // مجموع
        $SumPay = 0;
        foreach ($productbasket as $item) {
            $SumPay = $SumPay + ($item->product()->Price * $item->Counte);
        }

        // مالیات
        $Maliat = $SumPay * (10/100);

        //قابل پرداخت
        $KolePay = $SumPay + $Maliat;

        return view('front.basketproducts' , [
            'user_id' => $user_id,
            'productbasket' => $productbasket,
            'wallet' => $wallet,
            'SumPay' => $SumPay,
            'Maliat' => $Maliat,
            'KolePay' => $KolePay
        ]);
    }

    public function CheckOutPay($user_id)
    {
        $bakets = ProductBasket::where('user_id' , '=' , $user_id)->where('Status_Paying' , '=' , 0)->get();
        $wallet = Wallet::where('user_id' , '=' , $user_id)->first();

        // مجموع
        $SumPay = 0;
        foreach ($bakets as $item) {
            $SumPay = $SumPay + ($item->product()->Price * $item->Counte);
        }
        // مالیات
        $Maliat = $SumPay * (10/100);
        //قابل پرداخت
        $KolePay = $SumPay + $Maliat;

        if(isset($wallet->Price) && $wallet->Price >= $KolePay)
        {
            foreach ($bakets as $baket) {
                $baket->update(['Status_Paying' => 1]);
            }
            $wallet->update(['Price' => $wallet->Price - $KolePay]);
        }
        else
        {
            return redirect()->back()->with('message' , 'اعتبار کیف پول شما کافی نمی باشد !');
        }

        return redirect()->back()->with('message' , 'پرداخت با موفقیت انجام شد.');
    }
}
