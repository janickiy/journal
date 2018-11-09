@extends('layouts.performer')

@section('title', 'Редактирование заявки')

@section('content')

    <h2>Редактирование заявки</h2>

    <div class="row-fluid">

        <div class="col">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

                <!-- widget div-->
                <div>

                    <p>*-обязательные поля</p>

                    {!! Form::open(['url' => URL::route('frontend.performer.update'), 'method' => 'put', 'class' => 'form-horizontal']) !!}

                    {!! Form::hidden('id', $application->id) !!}

                    <div class="box-body">
                        <div class="form-group">

                            {!! Form::label('work_comment', 'Выполненные работы*', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                {!! Form::textarea('work_comment', old('work_comment', $application->work_comment), ['placeholder' => 'Выполненные работы', 'class' => 'form-control', 'rows' => 3]) !!}

                                @if ($errors->has('work_comment'))
                                    <span class="text-danger">{{ $errors->first('work_comment') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            {!! Form::label('worktypes_id', 'Тип работы*', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                {!! Form::select('worktypes_id', $options, $application->worktypes_id, ['placeholder' => 'Выберите', 'class' => 'form-control']) !!}

                                @if ($errors->has('worktypes_id'))
                                    <span class="text-danger">{{ $errors->first('worktypes_id') }}</span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">

                            {!! Form::label('service_comment', 'Комментарий', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                {!! Form::textarea('service_comment', old('service_comment', $application->service_comment), ['placeholder' => 'Комментарий (необязательно)', 'class' => 'form-control', 'rows' => 3]) !!}

                                @if ($errors->has('service_comment'))
                                    <span class="text-danger">{{ $errors->first('service_comment') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="col-sm-4">
                            <a href="{{ URL::route('frontend.performer.applications') }}" class="btn btn-danger btn-flat pull-right">Отменить</a>
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