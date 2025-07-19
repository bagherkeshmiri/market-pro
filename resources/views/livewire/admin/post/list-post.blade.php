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

                                            @forelse ($posts as $post)

                                                @php
                                                    $modalId = 'mainImageModal' . $post->id;
                                                @endphp

                                                <tr>

                                                    <td class="text-white">{{ $post->title }}</td>
                                                    <td class="text-white">{{ $post->slug }}</td>
                                                    <td class="text-white">{{ $post->category->name ?? ' - ' }}</td>
                                                    <td class="text-white">{{ $post->user->name ?? ' - ' }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $post->status_badge_class,  'content' => $post->status_label ])
                                                    </td>
                                                    <td class="text-white">{{ $post->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn-with-modal', [
                                                          'modalId' => 'post'.$post->id,
                                                          'icon' => showIcon(__('global.show')),
                                                      ])
                                                        {{--                                                        @include('frest-components.icon-btn',[  'href' => route('admin.faq.show',[ 'post' => $post->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])--}}
                                                    </td>
                                                </tr>

                                                @include('frest-components.text-preview-modal', [
                                                  'modalTitle' => ' محتوای پست ' . $post->title,
                                                  'modalId' => 'post'.$post->id,
                                                  'content' => $post->body,
                                              ])

                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.pagination',['model' => $posts] )

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
