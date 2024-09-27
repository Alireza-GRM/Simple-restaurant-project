
    @extends('layout.home')

    @section('homeContent')
        <h3 class="me-3 mt-4">رستوران | <span class="fs-5">{{ $restaurant->Title }}</span></h3>
        <h6 class="mb-3 me-3 mt-1">آدرس : <span> {{ $restaurant->Address }} </span></h6>

        <div class="container">
            <div class="row">
                <img class="ms-5 mb-5 rounded-5" src="{{ asset('image/'.$restaurant->image) }}" height="430">
            
                <h3 class="me-3 mb-2">درباره | <span class="fs-5">{{ $restaurant->Title }}</span></h3>
                <h6 class="me-3 mb-2">{!! $restaurant->Description !!}</h6>

                <div class=" row">
                    <h3 class="me-3">غذاهای | <span class="fs-5">{{ $restaurant->Title }}</span></h3>
                    <div class="bg-light rounded-3 shadow-ms me-4 p-3">
                        <ul class="nav nav-tabs">
                            @foreach ($category as $cate)
                                <li class="nav-item">
                                    <a class="nav-link Active HoverCategory" aria-current="page" href="{{ route('restaurant' , ['id' => $restaurant->id , 'category' => $cate->id]) }}">{{ $cate->Name }}</a>
                                </li>
                            @endforeach
                            <li class="nav-item">
                                <a class="nav-link Active HoverCategory" aria-current="page" href="{{ route('restaurant' , ['id' => $restaurant->id]) }}">همه</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @foreach ($product as $pro)
                    <div class="card  ms-3 mb-3 me-4 mt-3" style="width: 25rem;">
                        <div class="card-header">
                            {{ $restaurant->Title }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $pro->Name }}</h5>
                            <p class="card-text">{{ $pro->description }}</p>
                            @if (Auth::user())
                                <a href="{{ route('basket.add' , ['product_id' => $pro->id , 'restaurant_id' => $restaurant->id]); }}" class="btn btn-primary hoverbtnBay">افزودن به سبد</a>
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