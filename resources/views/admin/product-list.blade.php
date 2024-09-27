

@extends('layout.admin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <a href="{{ route('product-create') }}" class="col-2 btn btn-block btn-warning fw-bold">ثبت محصول</h6></a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>نام محصولات</th>
              <th>دسته بندی</th>
              <th>قیمت</th>
              <th>رستوران</th>
              <th class="fw-bold">ویرایش</th>
              <th class="fw-bold">حذف</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $pro)
            <tr>
              <td>{{ $pro->Name }}</td>
              <td>{{ $pro->category()->Name }}</td>
              <td>{{ number_format($pro->Price); }}</td>
              <td>{{ $pro->restaurant()->Title }}</td>
              <td><a href="{{ route('product-edit' , ['id' => $pro->id]) }}" class="text-decoration-none text-green">ویرایش</a></td>
              <td><a href="{{ route('product-delete' , ['id' => $pro->id]) }}" class="text-decoration-none text-red">حذف</a></td>
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