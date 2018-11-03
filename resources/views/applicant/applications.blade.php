@extends('layouts.applicant')

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


                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12 padding-bottom-10">
                                <a href="{{ URL::route('frontend.applicant.applyform') }}"
                                   class="btn btn-info btn-sm pull-left"><span class="fa fa-plus"> &nbsp;</span>Подать заявку</a>
                            </div>
                        </div>
                    </div>

                    <table id="itemList" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                        <tr>
                            <th data-hide="phone"> №</th>
                            <th data-hide="phone"> Время заявки</th>
                            <th data-hide="phone"> Заявка</th>
                            <th data-hide="phone"> Оборудование</th>
                            <th data-hide="phone"> Участок</th>
                            <th data-hide="phone"> Ответственный за ремонт</th>
                            <th data-hide="phone"> Описание проведенных работ</th>
                            <th data-hide="phone"> Окончание работы</th>
                            <th data-hide="phone"> Статус</th>
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
                ajax: '{!! URL::route('frontend.datatable.applications') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'disrepair_description', name: 'disrepair_description'},
                    {data: 'equipment', name: 'equipment'},
                    {data: 'area', name: 'area'},
                    {data: 'service_member', name: 'service_member'},
                    {data: 'work_comment', name: 'work_comment'},
                    {data: 'time_fixed', name: 'time_fixed'},
                    {data: 'status', name: 'status'},
                    {data: "actions", name: 'actions', orderable: false, searchable: false}
                ],
            });
        });

        // Delete start
        $(document).ready(function () {

            $('#itemList').on('click', 'a.deleteRow', function () {

                var btn = this;
                var rowid = $(this).attr('id');
                swal({
                        title: "Вы уверены?",
                        text: "Ваша заявка будет отменена!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Да, отменить!",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if (!isConfirm) return;
                        $.ajax({
                            url: SITE_URL + "/applicant/cancel/" + rowid,
                            type: "DELETE",
                            dataType: "html",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function () {
                                $("#rowid_" + rowid).remove();
                                swal("Сделано!", "Заявка отменена!", "success");
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                swal("Действия не были выполнены!", "Попробуйте еще раз", "error");
                            }
                        });
                    });
            });
        });
        // Delete End
    </script>
@endsection