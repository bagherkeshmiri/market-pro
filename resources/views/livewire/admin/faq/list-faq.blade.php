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

                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover">
                                            <thead>
                                            <tr>
                                                @foreach($tableHeads as $tableHead)
                                                    <th>{{ $tableHead }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody class="font-13">

                                            @forelse ($faqs as $faq)

                                                @php
                                                    $modalId = 'mainImageModal' . $faq->id;
                                                @endphp

                                                <tr>

                                                    <td class="text-white">{{ $faq->question }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $faq->is_active_badge_class,  'content' => $faq->is_active_label ])
                                                    </td>
                                                    <td class="text-white">{{ $faq->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn-with-modal', [
                                                          'modalId' => 'faq'.$faq->id,
                                                          'icon' => showIcon(__('global.show')),
                                                      ])
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.faq.show',[ 'faq' => $faq->id ])  , 'tooltipTitle' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                    </td>
                                                </tr>

                                                @include('frest-components.text-preview-modal', [
                                                  'modalTitle'            => 'متن سوال متداول',
                                                  'modalId'               => 'faq'.$faq->id,
                                                  'content'               => $faq->answer,
                                              ])

                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        {{ $faqs->links('frest-components.livewire-pagination',['elements' => $faqs]) }}

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
