
@extends('layout.home')


@section('homeContent')

    <h4 class="mt-5">رستوران های <span style="color: red !important;">علی فودکورد</span></h4>
    @foreach ($restaurant as $item)
        <div class="card ms-5 mt-4" style="width: 16rem;">
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