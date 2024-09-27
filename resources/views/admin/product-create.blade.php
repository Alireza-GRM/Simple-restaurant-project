@extends('layout.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('product-insert') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName"> Name food</label>
                            @error('nameFood')
                                <span class="text-red" style="margin-left: 10px;">(this name food is empty.)</span>
                            @enderror
                            <input type="text" class="form-control" name="nameFood" id="exampleInputName" placeholder="Name food">
                        </div>
                        <div class="form-group">
                            <label for="price"> Price food</label>
                            @error('price')
                                <span class="text-red" style="margin-left: 10px;">(this price food is empty.)</span>
                            @enderror
                            <input type="number" class="form-control" name="price" id="price" placeholder="Price food">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            @error('description')
                                <span class="text-red" style="margin-left: 10px;">(this description food is empty.)</span>
                            @enderror
                            <textarea class="form-control" name="description" style="resize:none;" rows="2" placeholder="Enter description..."></textarea>
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
                                        <option value="{{ $cate->id }}">{{ $cate->Name }}</option>
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
                                        <option value="{{ $res->id }}">{{ $res->Title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="col-2 btn btn-primary">Additional</button>
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