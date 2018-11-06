@extends('layouts.admin')

@section('title', $title)

@section('css')

    <style>
        .exportExcel{
            padding: 5px;
            border: 1px solid grey;
            margin: 5px;
            cursor: pointer;
        }
    </style>

@endsection

@section('content')

    @if (isset($title))<h2>{!! $title !!}</h2>@endif

    @include('layouts.admin_common.notifications')

    <div class="row-fluid">

        <div class="col">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

                <!-- widget div-->
                <div>

                    <table id="datatable_fixed_column" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>

                        <tr>

                            <th class="hasinput">
                                <input type="text" class="form-control" id="session-filter" placeholder="Фильтровать по серии карты" />
                            </th>

                            <th class="hasinput  FilterinputSearc" >
                                <input id="reportrange" type="text" placeholder="Фильтр Date" class="form-control" data-dateformat="YYYY-MM-DD hh:mm:ss - YYYY-MM-DD hh:mm:ss">
                                </th>

                            <th class="hasinput" >

                            </th>

                            <th class="hasinput" >
                                <input type="text" class="form-control" placeholder="Фильтровать по участоку" />
                            </th>

                            <th class="hasinput" >
                                <input type="text" class="form-control" placeholder="Фильтровать по оборудованию" />
                            </th>

                            <th class="hasinput" >
                                <input type="text" class="form-control" placeholder="Фильтровать по Описание неисправности" />
                            </th>

                            <th class="hasinput" >

                            </th>

                            <th class="hasinput" >
                                <input type="text" class="form-control" placeholder="Фильтровать по Представитель производства" />
                            </th>

                            <th class="hasinput" >
                                <input id="reportrange2" type="text" placeholder="Фильтр Date" class="form-control" data-dateformat="YYYY-MM-DD hh:mm:ss - YYYY-MM-DD hh:mm:ss">
                            </th>

                            <th class="hasinput" >
                                <input type="text" class="form-control" placeholder="Фильтровать по Представитель СГМ или СГЭ" />
                            </th>

                            <th class="hasinput" >

                            </th>

                            <th class="hasinput" >
                                <input type="text" class="form-control" placeholder="Фильтровать по Тип работы" />
                            </th>

                            <th class="hasinput" >

                            </th>

                            <th class="hasinput" >

                            </th>

                            <th class="hasinput" >

                            </th>
                        </tr>

                        <tr>
                            <th data-hide="phone">№</th>
                            <th data-hide="phone">Неисправность<br>обнаружена</th>
                            <th data-hide="phone">Меньше 30 мин.</th>
                            <th data-hide="phone">Участок</th>
                            <th data-hide="phone">Оборудование</th>
                            <th data-hide="phone">Описание неисправности</th>
                            <th data-hide="phone">Оборудование продолжает работать</th>
                            <th data-hide="phone">Представитель производства</th>
                            <th data-hide="phone">Неисправность устранена</th>
                            <th data-hide="phone">Представитель СГМ или СГЭ</th>
                            <th data-hide="phone">Выполненные работы</th>
                            <th data-hide="phone">Тип работы</th>
                            <th data-hide="phone">Комментарии мастера</th>
                            <th data-hide="phone">Комментарии специалиста<br>СГМ ил и СГЭ</th>
                            <th data-hide="phone">Статус</th>
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

        $(document).ready(function() {

            pageSetUp();

            /* // DOM Position key index //

            l - Length changing (dropdown)
            f - Filtering input (search)
            t - The Table! (datatable)
            i - Information (records)
            p - Pagination (paging)
            r - pRocessing
            < and > - div elements
            <"#id" and > - div with an id
            <"class" and > - div with a class
            <"#id.class" and > - div with an id and class

            Also see: http://legacy.datatables.net/usage/features
            */

            /* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };

            var startdate;
            var enddate;
            //instantiate datepicker and choose your format of the dates
            $('#reportrange').daterangepicker({
                    timePicker: true,
                    timePicker24Hour: true,
                    autoUpdateInput: false,

                    locale: {
                        format: 'YYYY-MM-DD hh:mm:ss',
                        applyLabel: 'Принять',
                        cancelLabel: 'Отмена',
                        invalidDateLabel: 'Выберите дату',
                        daysOfWeek: ['Сб', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Вс'],
                        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                        firstDay: 1
                    },
                    ranges: {
                        "Сегодня": [moment(), moment()],
                        'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'За последние 7 дней': [moment().subtract(6, 'days'), moment()],
                        'За последние 30 дней': [moment().subtract(29, 'days'), moment()],
                        'За этот месяц': [moment().startOf('month'), moment().endOf('month')],
                        'За прошлый месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                    ,
                    "opens": "right",
                },

                function (start_date, end_date) {
                    if (start_date && end_date) this.element.val(start_date.format('YYYY-MM-DD hh:mm:ss')+' - '+end_date.format('YYYY-MM-DD hh:mm:ss'));
                });

            //Filter the datatable on the datepicker apply event
            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                startdate = picker.startDate.format('YYYY-MM-DD hh:mm:ss');
                enddate = picker.endDate.format('YYYY-MM-DD hh:mm:ss');
                otable.draw();
            });

            var startdate2;
            var enddate2;

            //instantiate datepicker and choose your format of the dates
            $('#reportrange2').daterangepicker({
                    timePicker: true,
                    timePicker24Hour: true,
                    autoUpdateInput: false,

                    locale: {
                        format: 'YYYY-MM-DD hh:mm:ss',
                        applyLabel: 'Принять',
                        cancelLabel: 'Отмена',
                        invalidDateLabel: 'Выберите дату',
                        daysOfWeek: ['Сб', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Вс'],
                        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                        firstDay: 1
                    },
                    ranges: {
                        "Сегодня": [moment(), moment()],
                        'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'За последние 7 дней': [moment().subtract(6, 'days'), moment()],
                        'За последние 30 дней': [moment().subtract(29, 'days'), moment()],
                        'За этот месяц': [moment().startOf('month'), moment().endOf('month')],
                        'За прошлый месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                    ,
                    "opens": "right",
                },

                function (start_date2, end_date2) {
                    if (start_date2 && end_date2) this.element.val(start_date2.format('YYYY-MM-DD hh:mm:ss')+' - '+end_date2.format('YYYY-MM-DD hh:mm:ss'));
                });

            //Filter the datatable on the datepicker apply event
            $('#reportrange2').on('apply.daterangepicker', function(ev, picker) {
                startdate2 = picker.startDate.format('YYYY-MM-DD hh:mm:ss');
                enddate2 = picker.endDate.format('YYYY-MM-DD hh:mm:ss');
                otable.draw();
            });

            var otable = $('#datatable_fixed_column').DataTable({

               'createdRow': function( row, data, dataIndex ) {
                    $(row).attr('id', 'rowid_' + data['id']);
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!!URL::route('admin.datatable.journal') !!}',
                    data: function(d) {
                        d.date = $('#reportrange').val();
                    },
                    data: function(d) {
                        d.date = $('#reportrange2').val();
                    },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'less30min', name: 'less30min'},
                    {data: 'area.code', name: 'area.code'},
                    {data: 'equipment.name', name: 'equipment.name'},
                    {data: 'disrepair_description', name: 'disrepair_description'},
                    {data: 'continues_used', name: 'continues_used'},
                    {data: 'manufacturemember.name', name: 'manufacturemember.name'},
                    {data: 'time_fixed', name: 'time_fixed'},
                    {data: 'servicemember.name', name: 'servicemember.name'},
                    {data: 'work_comment', name: 'work_comment'},
                    {data: 'worktypes.code', name: 'worktypes.code'},
                    {data: 'master_comment', name: 'master_comment'},
                    {data: 'service_comment', name: 'service_comment'},
                    {data: 'status', name: 'status'},
                ],
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Экспортировать в excel',
                        className: 'exportExcel',
                        filename: 'Журнал простоев оборудования',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            }
                        }
                    },
                    {
                        extend: 'csv',
                        text: 'Экспортировать в csv',
                        charset: 'UTF-8',
                        bom: true,
                        className: 'exportExcel',
                        filename: 'Журнал простоев оборудования',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            }
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'Экспортировать в pdf',
                        className: 'exportExcel',
                        filename: 'Журнал простоев оборудования',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            }
                        }
                    },
                    ]
            });

            /* END BASIC */

            // Apply the filter
            $("#datatable_fixed_column thead th input[type=text]").on('keyup change', function () {

                otable
                    .column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
            });

            /* END COLUMN FILTER */
        });

    </script>


@endsection