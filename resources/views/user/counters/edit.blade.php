@extends('layouts.app')

@section('title', trans('messages.edit').' '.trans('messages.mainapp.menu.counter'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.add') }} {{ trans('messages.mainapp.menu.counter') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li><a href="{{ route('counters.index') }}">{{ trans('messages.mainapp.menu.counter') }}</a></li>
                        <li class="active">{{ trans('messages.edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3" style="padding-top:10px;padding-bottom:10px">
                <a class="btn-floating waves-effect waves-light orange tooltipped right" href="{{ route('counters.index') }}" data-position="top" data-tooltip="{{ trans('messages.cancel') }}"><i class="mdi-navigation-arrow-back"></i></a>
                <form id="edit" action="{{ route('counters.update', ['counters' => $counter->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col s12">
                            <label for="name">Jenis Counter</label>


                                

                            <select id="dropdown_selector" class="browser-default" data-error=".name">
                            
                                                    
                            @if($counter->name=="Loket")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="0">Loket</option>@endif
                            @if($counter->name=="Counter")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="100">Counter</option>@endif
                            @if($counter->name=="Teller")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="100">Teller</option>@endif
                            @if($counter->name=="CS")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="100">CS</option>@endif
                            @if($counter->name=="Kasir")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="0">Kasir</option>@endif
                            @if($counter->name=="Meja")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="0">Meja</option>@endif
                            @if($counter->name=="Lantai")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="0">Lantai</option>@endif
                            @if($counter->name=="Apotik")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="0">Apotik</option>@endif
                            @if($counter->name=="Service")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="0">Service</option>@endif
                            @if($counter->name=="Ruang")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="0">Ruang</option>@endif
                            @if($counter->name=="Bagian")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="0">Bagian</option>@endif
                            @if($counter->name=="Administrasi")<option value="{{ $counter->durasi }}" selected>{{ $counter->name }}</option>@else<option value="0">Administrasi</option>@endif
                                                    
                                                    
                                        </select>

                           <label for="nocounter">No Counter</label>
                            <select id="idcounter" class="browser-default" name="idcounter">
                            
                      @if($counter->idcounter=="1")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="1">1</option>  @endif   
                      @if($counter->idcounter=="2")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="2">2</option>  @endif
                      @if($counter->idcounter=="3")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="3">3</option>  @endif
                      @if($counter->idcounter=="4")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="4">4</option>  @endif
                      @if($counter->idcounter=="5")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="5">5</option>  @endif
                      @if($counter->idcounter=="6")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="6">6</option>  @endif
                      @if($counter->idcounter=="7")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="7">7</option>  @endif
                      @if($counter->idcounter=="8")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="8">8</option>  @endif
                      @if($counter->idcounter=="9")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="9">9</option>  @endif
                      @if($counter->idcounter=="10")<option value="{{ $counter->idcounter }}" selected>{{ $counter->idcounter }}</option>@else<option value="10">10</option>  @endif

                                                    
                                                   

                                                              
                                        </select>

                             <input id="name" type="hidden" value="{{ $counter->name }}" name="name"/>      
                            <input id="durasi" type="hidden" value="{{ $counter->idcounter }}" name="durasi"/>             
                            <div class="name">
                                @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
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
        $('#dropdown_selector').change(function()
    {
        /* setting currently changed option value to option variable */
        var option = $(this).find('option:selected');
        var value = option.val();//to get content of "value" attrib
        var text = option.text();//to get <option>Text</option> content
        /* setting input box value to selected option value */
        $('#name').val(text);
        $('#durasi').val(value);
    });
    </script>
@endsection
