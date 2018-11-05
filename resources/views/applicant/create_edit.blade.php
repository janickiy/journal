@extends('layouts.applicant')

@section('title', isset($equipment) ? 'Редактирование заявки' : 'Добавление заявки' )

@section('content')

    <h2>{!! isset($equipment) ? 'Редактирование' : 'Добавление' !!} заявки</h2>

    <div class="row-fluid">

        <div class="col">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

                <!-- widget div-->
                <div>

                    <p>*-обязательные поля</p>

                    {!! Form::open(['url' => isset($journal) ? URL::route('frontend.applicant.update') : URL::route('frontend.applicant.apply'), 'method' => isset($journal) ? 'put' : 'post', 'class' => 'form-horizontal']) !!}

                    {!! isset($journal) ? Form::hidden('id', $journal->id) : '' !!}

                    <div class="box-body">
                        <div class="form-group">

                            {!! Form::label('disrepair_description', 'Неисправность*', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                {!! Form::textarea('disrepair_description',  old('disrepair_description', isset($journal) ? $journal->disrepair_description : null), ['placeholder' => 'Неисправность', 'class' => 'form-control', 'rows' => 3]) !!}

                                @if ($errors->has('disrepair_description'))
                                    <span class="text-danger">{{ $errors->first('disrepair_description') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        {!! Form::label('equipment_id', 'Оборудование*', ['class' => 'col-sm-3 control-label']) !!}

                        <div class="col-sm-6">

                            {!! Form::select('equipment_id', $equipment_options,  old('equipment_id', isset($journal) ? $journal->equipment_id : null), ['placeholder' => 'Выберите', 'class' => 'form-control']) !!}

                            @if ($errors->has('equipment_id'))
                                <span class="text-danger">{{ $errors->first('equipment_id') }}</span>
                            @endif

                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="col-sm-4">
                            <a href="{{ URL::route('frontend.applicant.applications') }}" class="btn btn-danger btn-flat pull-right">Отменить</a>
                        </div>
                        <div class="col-sm-5 margin-bottom-10">

                            {!! Form::submit( 'Отправить', ['class'=>'btn btn-success']) !!}

                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">


    </script>
@endsection