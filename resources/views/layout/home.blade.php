<?php
    use App\Models\Category;
    use App\Models\ProductBasket;

    $category = Category::all();
    if (Auth::user()) {
        $productBasket = ProductBasket::where('user_id' , '=' , Auth::user()->id)->where('Status_Paying' , '=' , 0)->sum('Counte');
    }
?>
<html lang="ar" dir="rtl">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <title>ALI FOODCORD</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg alert p-3 Header">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold me-5 px-5 ColorHeader" style="font-size: 30px;" href="{{ route('home'); }}">علی فودکورد</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active ms-3 ColorHeader" aria-current="page" href="{{ route('home'); }}">خانه</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active ms-3 ColorHeader" aria-current="page" href="{{ route('restaurantAll'); }}">رستوران</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active ms-3 dropdown-toggle ColorHeader" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">دسته بندی</a>
                            <ul class="dropdown-menu">
                                @foreach ($category as $cate)
                                    <li><a class="dropdown-item" href="{{ route('home-category' , ['id' => $cate->id]); }}" style="font-size: 14px; text-align: right;">{{ $cate->Name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active ms-3 ColorHeader" aria-current="page" href="{{ route('home'); }}">درباره ما</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active ms-3 ColorHeader" aria-current="page" href="{{ route('home'); }}">تماس با ما</a>
                        </li>
                    </ul>
                    <form action="{{ route('searchHome') }}" class="d-flex me-5 mt-2" role="search" method="GET">
                        <input class="form-control txtSearch me-2" type="text" name="search" placeholder="جستجو کنید ..." aria-label="Search">
                        <button class="btn btnSearch me-1" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
                <div class="d-flex">
                    @if (Auth::user())
                        <li class="nav-item dropdown ColorHeader ms-5">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge" style="margin-right: -15px; background-color: green;">{{ $productBasket }}</span>
                            <a class="nav-link dropdown-toggle" style="font-size: 16px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('basket.show' , ['user_id' => Auth::user()->id]); }}" style="font-size: 14px; color: green; text-align: right;">سبد خرید {{ $productBasket }}</a></li>
                              <li><a class="dropdown-item" href="{{ route('logout') }}" style="font-size: 14px; color: red; text-align: right;">خروج از سیستم</a></li>
                            </ul>
                        </li>
                    @else
                        <a class="me-3 text-decoration-none text-dark ColorHeader ms-1" href="{{ route('login') }}">ورود</a>
                        <a class="me-3 text-decoration-none text-dark ColorHeader ms-5" href="{{ route('register') }}">ثبت نام</a>
                    @endif
                </div>
            </div>
        </nav>
        
        <div class="container">
            <div class="row">
                @yield('homeContent')
            </div>
        </div>


        <br>
        <br>
        <br>

        <div class="bg-dark">
            <div class="container">
                <footer class="py-5">
                  <div class="row">
                    <div class="col-6 col-md-4 mb-3">
                        <h4 class="text-white mb-4" style="color: #fdcb34 !important;">علی فودکورد</h4>
                        <p class="text-white">علی فودکورد، فرهنگ جدید سفارش غذاست که برای اولین بار در ایران معرفی و اجرا شده است. سفارش اینترنتی غذا در ايران تا قبل از راه‌اندازی اسنپ‌فود تنها یک رویا بود و کمتر کسی از مزایای آن خبر داشت. این رويا در سال ۱۳۸۸ به واقعيت تبديل شد و در این مدت طرفداران زیادی نيز بین مردم ایران پيدا كرده است.</p>
                    </div>
              
                    <div class="col-6 col-md-2 mb-3">
                      <h5 class="text-white me-4">لینک انتقال</h5>
                      <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">خانه</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">صفحه اصلی</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">نماد</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">مقاله</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">درباره ما</a></li>
                      </ul>
                    </div>
              
                    <div class="col-6 col-md-2 mb-3">
                      <h5 class="text-white me-4">راهنمایی</h5>
                      <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">خانه</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">صفحه اصلی</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">نماد</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">مقاله</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">درباره ما</a></li>
                      </ul>
                    </div>
              
                    <div class="col-md-3 offset-md-1 mb-3">
                      <form>
                        <h5 class="text-white">در خبرنامه ما مشترک شوید</h5>
                        <p class="text-white">خلاصه ماهانه چیزهای جدید و هیجان انگیز ما.</p>
                        <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                          <label for="newsletter1" class="visually-hidden text-white">آدرس ایمیل :</label>
                          <input id="newsletter1" type="text" class="form-control" placeholder="ایمیل">
                          <button class="btn btn-warning" type="button">ارسال</button>
                        </div>
                      </form>
                    </div>
                  </div>
              
                    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                        <p class="text-white">© 2022 Company, Inc. کلیه حقوق محفوظ است.</p>
                        <ul class="list-unstyled d-flex">
                            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
                            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
                            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
                        </ul>
                    </div>
                </footer>
            </div>
        </div>

        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    </body>
</html>