@extends('layout.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('product-update') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <label for="exampleInputName"> Name food</label>
                            @error('nameFood')
                                <span class="text-red" style="margin-left: 10px;">(this name food is empty.)</span>
                            @enderror
                            <input type="text" class="form-control" name="nameFood" id="exampleInputName" placeholder="Name food" value="{{ $product->Name }}">
                        </div>
                        <div class="form-group">
                            <label for="price"> Price food</label>
                            @error('price')
                                <span class="text-red" style="margin-left: 10px;">(this price food is empty.)</span>
                            @enderror
                            <input type="number" class="form-control" name="price" id="price" placeholder="Price food" value="{{ $product->Price }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            @error('description')
                                <span class="text-red" style="margin-left: 10px;">(this description food is empty.)</span>
                            @enderror
                            <textarea class="form-control" name="description" style="resize:none;" rows="2" placeholder="Enter description...">{{ $product->description }}</textarea>
                        </div>
                        <div class="col-sm-13">
                            <!-- select -->
                            <div class="form-group">
                                <label>category</label>
                                @error('category')
                                    <span class="text-red" style="margin-left: 10px;">(this category food is empty.)</span>
                                @enderror
                                <select name="category" class="form-control">
                                    @foreach ($category as $cate)
                                        @if ($cate->id == $product->category_id)
                                            <option value="{{ $cate->id }}" selected>{{ $cate->Name }}</option>
                                        @else
                                            <option value="{{ $cate->id }}">{{ $cate->Name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-13">
                            <!-- select -->
                            <div class="form-group">
                                <label>restorun</label>
                                @error('restorun')
                                    <span class="text-red" style="margin-left: 10px;">(this restaurant food is empty.)</span>
                                @enderror
                                <select name="restorun" class="form-control">
                                    @foreach ($restaurant as $res)
                                        @if ($res->id == $product->restaurant_id)
                                            <option value="{{ $res->id }}" selected>{{ $res->Title }}</option>
                                        @else
                                            <option value="{{ $res->id }}">{{ $res->Title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
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
    </div>
@endsection