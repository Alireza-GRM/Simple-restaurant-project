
@extends('layout.home')

@section('homeContent')
    <div class="container text-center mt-5">
        @if (count($rest) == 0)
            <h5>متاسفانه هیچ رستورانی یافت نشد!</h5>
        @endif
    </div>
    @foreach ($rest as $item)
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
@endsection