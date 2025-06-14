@section('title', $pageTitle )

@section('styles')

    @vite(['resources/css/frest/pages/page-user-profile.css'])

    <style>
        body {
            overflow-x: hidden;
        }
    </style>
@endsection



<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="page-user-profile">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="user-profile-images">
                                    <img src="{{ asset('/build/images/profile-banner.jpg') }}"
                                         class="img-fluid rounded-top user-timeline-image"
                                         alt="user timeline image">
                                    <img src="{{ asset('/build/images/avatar-s-16.png') }}"
                                         class="user-profile-image rounded-circle" alt="user profile image" height="140"
                                         width="140">
                                </div>
                                <div class="user-profile-text">
                                    <h4 class="mb-0 text-bold-500 profile-text-color">{{ $admin->name }}</h4>
                                </div>
                                <div class="card-body px-0">
                                    <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0"
                                        role="tablist">
                                        <li class="nav-item pb-0">
                                            <a class="nav-link d-flex px-1 active align-items-center" id="main-tab"
                                               data-toggle="tab" href="#main" aria-controls="main" role="tab"
                                               aria-selected="true"><i class="bx bx-home"></i><span
                                                        class="d-none d-md-block">اصلی</span></a>
                                        </li>
                                        <li class="nav-item pb-0">
                                            <a class="nav-link d-flex px-1 align-items-center" id="password-tab"
                                               href="{{ route('admin.profile.change-password') }}">
                                                <i class="bx bx-lock"></i><span
                                                        class="d-none d-md-block">تغییر رمز عبور</span></a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto">
                            <div class="col-lg-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="main" aria-labelledby="main-tab"
                                         role="tabpanel">
                                        <div class="row">

                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <h5 class="card-title">اطلاعات کامل</h5>
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                                <h6 class="mb-0"><small class="text-muted"> نام
                                                                    </small></h6>
                                                                <p><span class="ltr-text">{{ $admin->name }}</span>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                                <h6 class="mb-0"><small class="text-muted">ایمیل
                                                                    </small></h6>
                                                                <p><span class="ltr-text">{{ $admin->email }}</span>
                                                                </p>
                                                            </div>

                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                                <h6 class="mb-0"><small class="text-muted">تاریخ ثبت
                                                                        نام</small>
                                                                </h6>
                                                                <p><span
                                                                            class="ltr-text">{{ $admin->jalali_created_at }}</span>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <h6 class="mb-0"><small
                                                                            class="text-muted">بیوگرافی</small></h6>
                                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                                                                    چاپ و با استفاده از طراحان گرافیک است. چاپگرها و
                                                                    متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم
                                                                    است و برای شرایط فعلی تکنولوژی مورد نیاز و
                                                                    کاربردهای</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>





@section('scripts')
@endsection
