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
                                            <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments"
                                               aria-controls="payments" role="tab" aria-selected="false">
                                                <i class="bx bxs-credit-card align-middle"></i>
                                                <span class="align-middle">پرداخت ها</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders"
                                               aria-controls="orders" role="tab" aria-selected="false">
                                                <i class="bx bx-money align-middle"></i>
                                                <span class="align-middle">سفارشات</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses"
                                               aria-controls="orders" role="tab" aria-selected="false">
                                                <i class="bx bx-map align-middle"></i>
                                                <span class="align-middle">آدرس ها</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <livewire:admin.user.edit-user :user="$user" />
                                        </div>

                                        <div class="tab-pane" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                                            <livewire:admin.user.list-payments-user :user="$user" />
                                        </div>

                                        <div class="tab-pane" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                            <livewire:admin.user.list-orders-user :user="$user" />
                                        </div>


                                        <div class="tab-pane" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                                            <livewire:admin.user.list-addresses-user :user="$user" />
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
