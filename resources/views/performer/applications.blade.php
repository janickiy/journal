@extends('layouts.performer')

@section('title', $title)

@section('css')

@endsection


@section('content')

    <h2>{{ $title }}</h2>

    @include('layouts.admin_common.notifications')

    <div class="row-fluid">

        <div class="col">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

                <!-- widget div-->
                <div>

                    <table id="itemList" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                        <tr>
                            <th data-hide="phone"> №</th>
                            <th data-hide="phone"> Дата и врямя создания</th>
                            <th data-hide="phone"> Участок</th>
                            <th data-hide="phone"> Название оборудования</th>
                            <th data-hide="phone"> Описание неисправности</th>
                            <th data-hide="phone"> Комментарий мастера производства</th>
                            <th data-hide="phone,tablet"> Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->

    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $("#itemList").DataTable({
                'createdRow': function (row, data, dataIndex) {
                    $(row).attr('id', 'rowid_' + data['id']);
                },
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route('frontend.datatable.performer') !!}',
                columns: [

                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'area', name: 'area'},
                    {data: 'equipment', name: 'equipment'},
                    {data: 'disrepair_description', name: 'disrepair_description'},
                    {data: 'master_comment', name: 'master_comment'},
                    {data: "actions", name: 'actions', orderable: false, searchable: false}
                ],
            });
        });

        // Delete start
        $(document).ready(function () {

            $('#itemList').on('click', 'a.fixRow', function () {

                var btn = this;
                var rowid = $(this).attr('id');
                swal({
                        title: "Вы уверены?",
                        text: "Вы подверждаете, что неисправность устранена!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Да, подтвердить!",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if (!isConfirm) return;
                        $.ajax({
                            url: SITE_URL + "/performer/fix/" + rowid,
                            type: "GET",
                            dataType: "html",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function () {
                                $("#rowid_" + rowid).remove();
                                swal("Сделано!", "Неисправность устранена!", "success");
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                swal("Ошибка веб приложения!", "Действия не были выполнены", "error");
                            }
                        });
                    });
            });
        });
        // Delete End
    </script>
@endsection