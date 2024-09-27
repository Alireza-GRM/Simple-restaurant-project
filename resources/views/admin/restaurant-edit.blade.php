@extends('layout.admin')

@section('content')
        <div class="row">
            <div class="col-12">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('restaurant-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{ $restaurant->id }}">
                            <label for="exampleInputname"> Name restorun</label>
                            @error('name')
                                <span class="text-red" style="margin-left: 10px;">(this title restaurant is empty.)</span>
                            @enderror
                            <input type="text" class="form-control" name="name" id="exampleInputname" placeholder="Name restorun" value="{{ $restaurant->Title }}">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            @error('address')
                                <span class="text-red" style="margin-left: 10px;">(this address restaurant is empty.)</span>
                            @enderror
                            <textarea class="form-control" name="address" style="resize:none;" rows="3" placeholder="Enter address...">{{ $restaurant->Address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image"> Image</label>
                            <img src="{{ asset('image/'.$restaurant->image) }}" width="50px" height="50px" style=" margin-left: 5px; border-radius: 5px;">
                            @error('image')
                                <span class="text-red" style="margin-left: 10px;">(this image restaurant is invalid.)</span>
                            @enderror
                            <input type="file" class="form-control mt-2" name="image" id="image" placeholder="Choose image" value="{{ asset('image/'.$restaurant->image) }}">
                        </div>
                        <div class="form-group d-flex">
                            <label for="check" style="margin-left: 30px;"> Show in slide home</label>
                            <input type="checkbox" class="form-check-input" style="margin-left: 7px;" name="check" id="check" value=1 {{ $restaurant->Is_Slide == 1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            @error('address')
                                <span class="text-red" style="margin-left: 10px;">(this description restaurant is empty.)</span>
                            @enderror
                            <textarea class="form-control" id="tiny" name="description" style="resize:none;" rows="4" placeholder="Enter address...">{!! $restaurant->Description !!}</textarea>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="col-2 btn btn-primary">Edit</button>
                        </div>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger" style="width: 600px; left: 20px; border-radius: 20px">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <!-- /.card -->
        </div>
@endsection