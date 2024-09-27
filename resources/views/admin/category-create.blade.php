@extends('layout.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('category-insert') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName">Name category</label>
                            @error('nameCategory')
                                <span class="text-red" style="margin-left: 10px;">(this name Category is empty.)</span>
                            @enderror
                            <input type="text" class="form-control" name="nameCategory" id="exampleInputName" placeholder="Name category">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            @error('description')
                                <span class="text-red" style="margin-left: 10px;">(this description Category is empty.)</span>
                            @enderror
                            <textarea class="form-control" name="description" style="resize:none;" rows="3" placeholder="Enter description..."></textarea>
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