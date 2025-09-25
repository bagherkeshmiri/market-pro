@section('styles')
@endsection


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">

            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card border">
                            <div class="card-content">
                                <div class="card-body">


                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                               aria-controls="home" role="tab" aria-selected="true">
                                                <i class="bx bx-home align-middle"></i>
                                                <span class="align-middle">اطلاعات</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="change-password-tab" data-toggle="tab"
                                               href="#change-password"
                                               aria-controls="orders" role="tab" aria-selected="false">
                                                <i class="bx bx-check-shield align-middle"></i>
                                                <span class="align-middle">تغییر رمز عبور</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="home" role="tabpanel"
                                             aria-labelledby="home-tab">
                                            <livewire:admin.admin.edit-admin :admin="$admin"/>
                                        </div>

                                        <div class="tab-pane" id="change-password" role="tabpanel"
                                             aria-labelledby="change-password-tab">
                                            <livewire:admin.admin.change-password-admin :admin="$admin"/>
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
    <script>
        $(document).ready(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            const activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
@endsection
