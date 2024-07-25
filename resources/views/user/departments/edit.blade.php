@extends('layouts.app')

@section('title', trans('messages.edit').' '.trans('messages.mainapp.menu.department'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.add') }} {{ trans('messages.mainapp.menu.department') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li><a href="{{ route('departments.index') }}">{{ trans('messages.mainapp.menu.department') }}</a></li>
                        <li class="active">{{ trans('messages.edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3" style="padding-top:10px;padding-bottom:10px">
                <a class="btn-floating waves-effect waves-light orange tooltipped right" href="{{ route('departments.index') }}" data-position="top" data-tooltip="{{ trans('messages.cancel') }}"><i class="mdi-navigation-arrow-back"></i></a>
                <form id="edit" action="{{ route('departments.update', ['departments' => $department->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">{{ trans('messages.name') }}</label>
                            <input id="name" type="text" name="name" placeholder="{{ trans('messages.mainapp.menu.department') }} {{ trans('messages.name') }}" value="{{ $department->name }}" data-error=".name">
                            <div class="name">
                                @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                           <select id="letter" class="browser-default" name="letter">
        @if($department->letter=="A")<option value="A" selected>A</option>@else <option value="A">A</option> @endif 
        @if($department->letter=="B")<option value="B" selected>B</option>@else <option value="B">B</option> @endif 
        @if($department->letter=="C")<option value="C" selected>C</option>@else <option value="C">C</option> @endif 
        @if($department->letter=="D")<option value="D" selected>D</option>@else <option value="D">D</option> @endif 
        @if($department->letter=="E")<option value="E" selected>E</option>@else <option value="E">E</option> @endif 
        @if($department->letter=="F")<option value="F" selected>F</option>@else <option value="F">F</option> @endif 
        @if($department->letter=="G")<option value="G" selected>G</option>@else <option value="G">G</option> @endif 
        @if($department->letter=="H")<option value="H" selected>H</option>@else <option value="H">H</option> @endif 
        @if($department->letter=="I")<option value="I" selected>I</option>@else <option value="I">I</option> @endif 
        @if($department->letter=="J")<option value="J" selected>J</option>@else <option value="J">J</option> @endif 
        @if($department->letter=="K")<option value="K" selected>K</option>@else <option value="K">K</option> @endif 
        @if($department->letter=="L")<option value="L" selected>L</option>@else <option value="L">L</option> @endif 
        @if($department->letter=="M")<option value="M" selected>M</option>@else <option value="M">M</option> @endif 
        @if($department->letter=="N")<option value="N" selected>N</option>@else <option value="N">N</option> @endif 
        @if($department->letter=="O")<option value="O" selected>O</option>@else <option value="O">O</option> @endif 
        @if($department->letter=="P")<option value="P" selected>P</option>@else <option value="P">P</option> @endif 
        @if($department->letter=="Q")<option value="Q" selected>Q</option>@else <option value="Q">Q</option> @endif 
        @if($department->letter=="R")<option value="R" selected>R</option>@else <option value="R">R</option> @endif 
        @if($department->letter=="S")<option value="S" selected>S</option>@else <option value="S">S</option> @endif 
        @if($department->letter=="T")<option value="T" selected>T</option>@else <option value="T">T</option> @endif 
        @if($department->letter=="U")<option value="Y" selected>U</option>@else <option value="U">U</option> @endif 
        @if($department->letter=="V")<option value="V" selected>V</option>@else <option value="P">P</option> @endif 
        @if($department->letter=="W")<option value="W" selected>W</option>@else <option value="W">W</option> @endif 
        @if($department->letter=="X")<option value="X" selected>X</option>@else <option value="X">X</option> @endif 
        @if($department->letter=="Y")<option value="Y" selected>Y</option>@else <option value="Y">Y</option> @endif 
        @if($department->letter=="Z")<option value="Z" selected>Z</option>@else <option value="Z">Z</option> @endif 

                                        </select>
                            <div class="letter">
                                @if($errors->has('letter'))<div class="error">{{ $errors->first('letter') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="start">{{ trans('messages.department.start') }}</label>
                            <input id="start" type="text" name="start" placeholder="{{ trans('messages.department.start') }}" value="{{ $department->start }}" data-error=".start">
                            <div class="start">
                                @if($errors->has('start'))<div class="error">{{ $errors->first('start') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="limit">Limit antrian perhari / *max 300 orang</label>
                            <input id="limit_antrian" type="number" name="limit_antrian" placeholder="Limit antrian perhari" value="{{ $department->limit_antrian }}" data-error=".limit">
                            <div class="limit">
                                @if($errors->has('limit_antrian'))<div class="error">{{ $errors->first('limit_antrian') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right" type="submit">
                                {{ trans('messages.update') }}<i class="mdi-action-swap-vert left"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#edit").validate({
            rules: {
                name: {
                    required: true
                },
                start: {
                    required: true,
                    digits: true
                },
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
@endsection
