@section('title',$pageTitle)


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

{{--                                                        <a data-toggle="modal" data-target="#comment5">--}}
{{--                                                            <i id="bx-show" class="bx bx-show" data-toggle="tooltip" data-placement="top" title="نمایش"></i>--}}
{{--                                                        </a>--}}




                                                        @include('frest-components.icon-btn-with-modal', [
                                                           'modalId'               => 'comment'.$comment->id,
                                                           'icon'               => showIcon('نمایش'),
                                                       ])



                                                        {{--                                                        @include('frest-components.icon-btn',['hasModal'  => true ,'modalId' => 'comment'.$comment->id , 'tooltipTitle' => 'نمایش' , 'icon' => showIcon() ])--}}
                                                        {{--                                                        @include('frest-components.icon-btn',[  'href' => ''  , 'tooltip_title' => 'تایید' , 'icon' => successCheckIcon() ])--}}
                                                        {{--                                                        @include('frest-components.icon-btn',[  'href' => ''  , 'tooltip_title' => 'رد' , 'icon' => dangerXIcon() ])--}}
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

                                        @include('frest-components.pagination',['model' => $comments] )

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
