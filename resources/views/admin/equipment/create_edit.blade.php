@extends('layouts.admin')

@section('title', isset($role) ? 'Редактирование оборудования' : 'Добавление оборудования' )

@section('content')

    <h2>{!! isset($equipment) ? 'Редактирование' : 'Добавление' !!} роли</h2>

    <div class="row-fluid">

        <div class="col">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

                <!-- widget div-->
                <div>

                    <p>*-обязательные поля</p>

                    {!! Form::open(['url' => isset($equipment) ? URL::route('admin.equipment.update') : URL::route('admin.equipment.store'), 'method' => isset($equipment) ? 'put' : 'post', 'class' => 'form-horizontal']) !!}

                    {!! isset($equipment) ? Form::hidden('id', $equipment->id) : '' !!}

                    <div class="box-body">
                        <div class="form-group">

                            {!! Form::label('name', 'Название*', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                {!! Form::text('name', old('name', isset($equipment->name) ? $equipment->name : null), ['class' => 'form-control', 'placeholder'=>'Название', 'id' => 'name']) !!}

                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            {!! Form::label('description', 'Описание', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                {!! Form::textarea('description', old('description', isset($equipment) ? $equipment->description : null), ['placeholder' =>'Описание','class' => 'form-control', 'rows' => 3]) !!}

                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            {!! Form::label('published', 'Активна', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                <label class="check">{!! Form::checkbox('status', 1, isset($equipment) ? ($equipment->status ? true : false) : true, ['class'=>'minimal']) !!}
                                    Да
                                </label>

                            </div>
                        </div>




                    </div>

                    <div class="box-footer">
                        <div class="col-sm-4">
                            <a href="{{ URL::route('admin.equipment.list') }}" class="btn btn-danger btn-flat pull-right">Отменить</a>
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