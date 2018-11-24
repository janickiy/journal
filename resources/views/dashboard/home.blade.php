@extends('layouts.dashboard')

@section('title', 'Главаня страница')

@section('css')

@endsection


@section('content')

    @if (isset($title))<h2>{!! $title !!}</h2>@endif

    @include('layouts.dashboard_common.notifications')

    <div class="row-fluid">

        <div class="col">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

                <!-- widget div-->
                <div>


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


    </script>
@endsection