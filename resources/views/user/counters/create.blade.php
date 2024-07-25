@extends('layouts.app')

@section('title', trans('messages.add').' '.trans('messages.mainapp.menu.counter'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.add') }} {{ trans('messages.mainapp.menu.counter') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li><a href="{{ route('counters.index') }}">{{ trans('messages.mainapp.menu.counter') }}</a></li>
                        <li class="active">{{ trans('messages.add') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3" style="padding-top:10px;padding-bottom:10px">
                <a class="btn-floating waves-effect waves-light orange tooltipped right" href="{{ route('counters.index') }}" data-position="top" data-tooltip="{{ trans('messages.cancel') }}" style="background:red;"><i class="mdi-navigation-arrow-back"></i></a>
                <form id="add" action="{{ route('counters.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col s12">
                            
                       

                    <label for="name">Jenis Counter</label>
                            <select id="dropdown_selector" class="browser-default" data-error=".name">
                                                    <option selected>-Pilih-</option>
                                                    <option value="0">Loket</option>
                                                    <option value="100">Counter</option>
                                                    <option value="100">Teller</option>
                                                    <option value="100">CS</option>
                                                    <option value="0">Kasir</option>
                                                    <option value="0">Meja</option>
                                                    <option value="0">Lantai</option>
                                                    <option value="0">Apotik</option>
                                                    <option value="0">Service</option>
                                                    <option value="0">Ruang</option>
                                                    <option value="0">Bagian</option>
                                                    <option value="0">Administrasi</option>
                                        </select>
                           
                            <div class="name">
                                @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
                            </div>

                    <label for="nocounter">No Counter</label>
                            <select id="idcounter" class="browser-default" name="idcounter">
                                                    <option value="1" selected>1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                        </select>
                            
                     </div>
                      <input id="name" type="hidden" name="name"/>      
                      <input id="durasi" type="hidden" name="durasi"/>   
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right" type="submit" style="background:red;">
                                {{ trans('messages.save') }}<i class="mdi-content-save left"></i>
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
        $("#add").validate({
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
        var text = option.text();
        //var kredit = option.addClass().attr("class");
        /* setting input box value to selected option value */
        $('#name').val(text);
        $('#durasi').val(value);
        //$('#lainnya').val(kredit);
    });
    </script>
@endsection
