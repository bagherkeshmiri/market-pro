
@section('styles')
@endsection

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">

            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card border ">
                            <div class="card-content">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover" style="cursor:pointer;">
                                            <thead>
                                            <tr>
                                                @foreach($tableHeads as $tableHead)
                                                    <th>{{ $tableHead }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody class="font-13" id="collection-list-table">

                                            @forelse ($comments as $comment)

                                                <tr>
                                                    <td class="text-white">{{ $comment->user->name }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $comment->Commentable_type_badge_class ,  'content' => $comment->Commentable_type_label  ])
                                                    </td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $comment->status_badge_class,  'content' => $comment->status_label ])
                                                    </td>

                                                    <td class="text-white">{{ $comment->jalali_created_at }}</td>
                                                    <td>

                                                        @include('frest-components.icon-btn-with-modal', [
                                                           'modalId'               => 'comment'.$comment->id,
                                                           'icon'               => showIcon(__('global.show')),
                                                       ])


                                                        @if($comment->status == \App\Enums\CommentStatus::Pending)
                                                            @include('frest-components.icon-btn', [
                                                                'tooltipTitle'=> __('global.approve'),
                                                                'icon'         => successCheckIcon(),
                                                                'isClick' => true,
                                                                'wire' => "approve($comment->id)"
                                                            ])

                                                            @include('frest-components.icon-btn', [
                                                                 'tooltipTitle'=> __('global.reject'),
                                                                 'icon'         => dangerXIcon(),
                                                                 'isClick' => true,
                                                                 'wire' =>  "reject($comment->id)"
                                                            ])
                                                        @endif

                                                    </td>
                                                </tr>

                                                @include('frest-components.text-preview-modal', [
                                                  'modalTitle'            => 'متن نظر',
                                                  'modalId'               => 'comment'.$comment->id,
                                                  'content'               => $comment->body,
                                              ])

                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        {{ $comments->links('frest-components.pagination',['elements' => $comments]) }}

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
