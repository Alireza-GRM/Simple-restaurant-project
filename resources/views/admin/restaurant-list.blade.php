
@extends('layout.admin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <a href="{{ route('restaurant-create') }}" class="col-2 btn btn-block btn-warning fw-bold">ثبت رستوران</h6></a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>نام رستوران</th>
              <th>آدرس</th>
              <th>تصویر</th>
              <th class="fw-bold">ویرایش</th>
              <th class="fw-bold">حذف</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($restaurants as $res)
            <tr>
              <td>{{ $res->Title }}</td>
              <td>{{ $res->Address }}</td>
              <td><img src="{{ asset('image/'.$res->image) }}" style="border-radius: 10px" width="50" height="50"></td>
              <td><a href="{{ route('restaurant-edit' ,['id' => $res->id]) }}" class="text-decoration-none text-green">ویرایش</a></td>
              <td><a href="{{ route('restaurant-delete' , ['id' => $res->id]) }}" class="text-decoration-none text-red">حذف</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@endsection