@section('title',$pageTitle)

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/pages/widgets.css') }}">
@endsection


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section id="widgets-Statistics">
                <div class="row">
                    @foreach($widgetsStatistics as $widgetsStatistic)
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="badge-circle badge-circle-lg {{ $widgetsStatistic[1] }} mx-auto my-1">
                                            <i class="bx {{ $widgetsStatistic[2] }}  font-medium-5"></i>
                                        </div>
                                        <p class="text-muted mb-0 line-ellipsis">{{ $widgetsStatistic[0] }}</p>
                                        <h2 class="mb-0 primary-font">{{ $widgetsStatistic[3] }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>


@section('scripts')
    <script type="text/javascript" src="{{ asset('js/frest/scripts/cards/widgets.js') }}"></script>
@endsection
