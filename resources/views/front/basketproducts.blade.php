@extends('layout.home')

@section('homeContent')

    <div class="col-lg-8 col-md-4 mt-4">
        <div class="bg-light rounded-4 p-4">
            <h5 class="text-success me-4">ادامه فرایند خرید | {{ $productbasket->sum('Counte') }} سفارش</h5>
        </div>
        <div class="bg-light rounded-4 p-4 mt-3">
            <h6 class="me-4">سفارشات {{ Auth::user()->name }} </h6>
            <hr>
            <div class="row me-4">
                <h6 class="mb-4">سبد خرید : </h6>
                @if ($KolePay == 0)
                    <h5 class="text-danger">در حال حاضر هیچ سفارشی وجود ندارد !</h5>
                @endif
                @if (session('message2'))
                    <div class="alert alert-danger mt-4">
                        {{ session('message2') }}
                    </div>
                @endif
                @foreach ($productbasket as $item)
                    <div class="ms-5">
                        <div class="menu-item">
                            <form action="{{ route('deleteProduct' , ['id' => $item->id]); }}">
                                <button type="submit" class="delete-btn"><i class="bi bi-trash"></i></button>
                            </form>
                            <div class="item-info">
                                <div class="item-name">{{ $item->product()->Name }} ({{ $item->Counte }}<span class="me-1">عدد</span>) : </div>
                                <div class="item-restaurant">رستوران {{ $item->restaurant()->Title }}</div>
                                <div class="item-total">مجموع : {{ number_format($item->product()->Price * $item->Counte) }} <span style="font-size: 14px;">تومان</span></div>
                            </div>
                            <div class="item-price">{{ number_format($item->product()->Price); }} <span style="font-size: 14px;">تومان</span></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row me-4">            
                <div class="ms-5">
                    <div class="menu-item">
                        <div class="item-info me-5">
                            <div class="item-restaurant">مجموع : </div>
                            <div class="item-restaurant">مالیات : </div>
                            <div class="item-restaurant">هزینه ارسال : </div>
                            <div class="item-name mt-3">قابل پرداخت : </div>
                        </div>
                        <div class="item-info ms-5" style="text-align: left;">
                            <div class="item-pay">{{ number_format($SumPay); }} <span style="font-size: 14px;">تومان</span></div>
                            <div class="item-pay">{{ number_format($Maliat); }} <span style="font-size: 14px;">تومان</span></div>
                            <div class="item-pay">رایگان</div>
                            <div class="item-name mt-3">{{ number_format($KolePay); }} <span style="font-size: 14px;">تومان</span></div>
                        </div>
                    </div>
                    <form action="{{ route('CheckOutPay' , ['user_id' => Auth::user()->id]); }}" method="GET">
                        @if ($KolePay != 0)
                            <button type="submit" class="btn btn-success mt-2 pe-4 ps-4" style="font-size: 15px;">ثبت سفارش و پرداخت</button>
                        @else
                            <button type="submit" class="btn btn-success mt-2 pe-4 ps-4 disabled" style="font-size: 15px;">ثبت سفارش و پرداخت</button>
                        @endif
                        @if (session('message') == 'اعتبار کیف پول شما کافی نمی باشد !')
                            <div class="alert alert-danger mt-4">
                                {{ session('message') }}
                            </div>
                        @elseif (session('message') == 'پرداخت با موفقیت انجام شد.')
                            <div class="alert alert-success mt-4">
                                {{ session('message') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 mt-4">
        <div class="bg-light rounded-4 p-4">
            <div class="card text-bg-dark">
                <img src="{{ asset('image/CardBank.webp') }}" class="card-img">
                <div class="card-img-overlay">
                  <h5 class="card-title text-dark pe-3">کیف پول <span style="color: red !important;">علی فودکورد</span></h5>
                  <p class="card-text text-dark pe-3">{{ Auth::user()->name }}</p>
                  <p class="card-text text-dark pe-3 pt-3"> اعتبار شما : {{ number_format($wallet->Price ?? 0); }} تومان</p>
                  <p class="card-text text-dark pe-3"><small>با شارژ کردن کیف پول خود تا سقف یک میلیون تومان خرید کنید.</small></p>
                </div>
            </div>
            <form class="row g-3 mt-5" action="{{ route('walletCharg'); }}" method="POST">
                @csrf
                @error('PriceCharg')
                    <span class="text-red" style="margin-left: 10px; font-size: 13px; color: red !important;"> لطفا مبلغ شارژ را وارد کنید!</span>
                @enderror
                <div class="col-auto">
                    <input type="number" name="PriceCharg" class="form-control" id="inputPassword2" placeholder="مبلغ مورد نظر">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success mb-3" style="font-size: 15px;">افزایش اعتبار</button>
                </div>
                <p>توجه : مبلغ مورد نظر را به <span style="color: red !important;">تومان</span> وارد کنید.</p>
            </form>
        </div>
    </div>

@endsection