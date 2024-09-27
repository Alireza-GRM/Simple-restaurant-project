
@extends('layout.admin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <a href="{{ route('category-create') }}" class="col-2 btn btn-block btn-warning fw-bold">ثبت دسته بندی</h6></a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>دسته بندی</th>
              <th>توضیحات</th>
              <th class="fw-bold">ویرایش</th>
              <th class="fw-bold">حذف</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $cate)
              <tr>
                <td>{{ $cate->Name }}</td>
                <td>{{ $cate->description }}</td>
                <td><a href="{{ route('category-edit' , ['id' => $cate->id]) }}" class="text-decoration-none text-green">ویرایش</a></td>
                <td><a href="{{ route('category-delete' , ['id' => $cate->id]) }}" class="text-decoration-none text-red">حذف</a></td>
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