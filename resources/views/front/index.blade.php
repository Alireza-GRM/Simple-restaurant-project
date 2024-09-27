
@extends('layout.home')

@section('homeContent')

    
    <div id="carouselExampleCaptions" class="carousel slide mt-4">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @foreach ($restaurantSlide as $slide)
                <div class="carousel-item active">
                    <img src="{{ asset('image/'.$slide->image) }}" class="d-block w-100 rounded-4" height="500px">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="container bg-dark rounded-4 p-2" style="width: 200px;">
                            <h3>{{ $slide->Title }}</h3>
                            <p>{{ $slide->Address }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h2 class="mt-5"><span style="color: #fbbc00 !important;">جدیدترین</span> رستوران ها</h2>
    @foreach ($restaurant as $item)
        <div class="card ms-2 mt-3" style="width: 16rem;">
            <div class="card-body">
                <a class="text-decoration-none text-dark" href= "{{ route('restaurant' , ['id' => $item->id]); }}">
                    <h5 class="card-title mb-3">رستوران {{ $item->Title }}</h5>
                </a>
                <img src="{{ asset('image/'.$item->image) }}" width="200" height="130" style="border-radius: 10px;">
                <h6 class="card-subtitle mb-2 text-body-secondary mt-2">آدرس : {{ $item->Address }}</h6>
            </div>
        </div>
    @endforeach

    <h2 class="mt-5"><span style="color: #fbbc00 !important;">بهترین</span> رستوران ها</h2>
    @foreach ($BestRestaurant as $best)
        <div class="card ms-2 mt-3" style="width: 16rem;">
            <div class="card-body">
                <a class="text-decoration-none text-dark" href= "{{ route('restaurant' , ['id' => $best->id]); }}">
                    <h5 class="card-title mb-3">رستوران {{ $best->Title }}</h5>
                </a>
                <img src="{{ asset('image/'.$best->image) }}" width="200" height="130" style="border-radius: 10px;">
                <h6 class="card-subtitle mb-2 text-body-secondary mt-2">آدرس : {{ $best->Address }}</h6>
            </div>
        </div>
    @endforeach

    <div class="row mt-3">
        <div class="card ms-2 mt-3 text-center" style="width: 16rem;">
            <h3 class="mt-2">تعداد کاربران</h3>
            <h4 class="mt-3">{{ $userCount }}</h4>
        </div>
    </div>
    
    {{-- paginate --}}
    {{-- <div class="row">
        {{ $restaurant->links(); }}
    </div> --}}
@endsection