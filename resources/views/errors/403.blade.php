@extends('layouts.errors-master')

@section('title', __('Forbidden'))

@section('contents')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><!-- not authorized start -->
                <section class="row flexbox-container">
                    <div class="col-xl-7 col-md-8 col-12">
                        <div class="card bg-transparent shadow-none">
                            <div class="card-content">
                                <div class="card-body text-center bg-transparent miscellaneous">
                                    <img src="{{ asset('frest/images/pages/not-authorized.png') }}" class="img-fluid" alt="not authorized" width="400">
                                    <h1 class="my-2 error-title">شما مجاز به دسترسی نیستید!</h1>
                                    <p>
                                        شما مجوز لارم برای مشاهده این دایرکتوری یا صفحه را ندارید.
                                    </p>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary round glow mt-2">بازگشت به داشبورد</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- not authorized end -->

            </div>
        </div>
    </div>

@endsection
