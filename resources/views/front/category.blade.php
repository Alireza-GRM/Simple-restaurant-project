@extends('layout.home')

@section('homeContent')
    <div class="container">
        <div class="row">
            @foreach ($category->product() as $pro)
                <div class="card  ms-3 mb-3 me-4 mt-3" style="width: 25rem;">
                    <div class="card-header">
                        {{ $category->Name }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $pro->Name }}</h5>
                        <p class="card-text">{{ $pro->description }}</p>
                        @if (Auth::user())
                            <a href="{{ route('basket.add' , ['product_id' => $pro->id , 'restaurant_id' => $pro->restaurant_id]); }}" class="btn btn-primary hoverbtnBay">افزودن به سبد</a>
                        @else
                            <a href="#" class="btn btn-primary hoverbtnBay disabled">افزودن به سبد</a>
                        @endif
                        <span class="me-2" style="float: left; font-weight: bold; color: green">تومان</span>
                        <h4 style="float: left;">{{ number_format($pro->Price); }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection