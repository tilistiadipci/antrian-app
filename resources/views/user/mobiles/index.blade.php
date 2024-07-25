@extends('layouts.app')

@section('title', trans('messages.settings'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">Pengaturan Mobile</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">Pengaturan Mobile</a></li>
                        <li class="active">{{ trans('messages.settings') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<form id="mobile" action="{{ route('post_mobiles') }}" method="post" enctype='multipart/form-data'>
    {{ csrf_field() }}
    <div class="container">   
            <div class="row">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Slider 1</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="slider_jdl1">Slider 1</label>
                                        <input id="slider_jdl1" type="text" name="slider_jdl1" placeholder="Judul Slider 1" value="{{ $mobiles->slider_jdl1 }}" data-error=".slider_jdl1">
                                        <input id="slider_des1" type="text" name="slider_des1" placeholder="Deskripsi Slider 1" value="{{ $mobiles->slider_des1 }}" data-error=".slider_des1">
                                        <div class="slider_jdl1">
                                            @if($errors->has('slider_jdl1'))<div class="error">{{ $errors->first('slider_jdl1') }}</div>@endif
                                        </div>
                                        <div class="slider_des1">
                                            @if($errors->has('slider_des1'))<div class="error">{{ $errors->first('slider_des1') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                         <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Slider 2</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="slider_jdl2">Slider 2</label>
                                        <input id="slider_jdl2" type="text" name="slider_jdl2" placeholder="Judul Slider 2" value="{{ $mobiles->slider_jdl2 }}" data-error=".slider_jdl2">
                                        <input id="slider_des2" type="text" name="slider_des2" placeholder="Deskripsi Slider 2" value="{{ $mobiles->slider_des2 }}" data-error=".slider_des2">
                                        <div class="slider_jdl2">
                                            @if($errors->has('slider_jdl2'))<div class="error">{{ $errors->first('slider_jdl2') }}</div>@endif
                                        </div>
                                        <div class="slider_des2">
                                            @if($errors->has('slider_des2'))<div class="error">{{ $errors->first('slider_des2') }}</div>@endif
                                        </div>
                                    </div>
                                </div>

                        </div>
                         <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Slider 3</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="slider_jdl1">Slider 3</label>
                                        <input id="slider_jdl3" type="text" name="slider_jdl3" placeholder="Judul Slider 3" value="{{ $mobiles->slider_jdl3 }}" data-error=".slider_jdl3">
                                        <input id="slider_des3" type="text" name="slider_des3" placeholder="Deskripsi Slider 3" value="{{ $mobiles->slider_des3 }}" data-error=".slider_des3">
                                        <div class="slider_jdl3">
                                            @if($errors->has('slider_jdl3'))<div class="error">{{ $errors->first('slider_jdl3') }}</div>@endif
                                        </div>
                                        <div class="slider_des3">
                                            @if($errors->has('slider_des3'))<div class="error">{{ $errors->first('slider_des3') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">

                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Slider Background</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
        <div class="col m2" style="width:103px;height:60px;">
            @if($mobiles->sliderbg1!="-")

                <img width="100" src="{{ asset('assets/images/bg/') }}/{{ $mobiles->sliderbg1 }}">
        @else
                <img src="{{ asset('assets/images') }}/nosignal.jpg" width="100" >
        @endif
        </div>

        <div class="col m2" style="width:103px;height:60px;">
            @if($mobiles->sliderbg2!="-")

                <img width="100" src="{{ asset('assets/images/bg/') }}/{{ $mobiles->sliderbg2 }}">
        @else
                <img src="{{ asset('assets/images') }}/nosignal.jpg" width="100" >
        @endif
        </div>

        <div class="col m2" style="width:103px;height:60px;">
            @if($mobiles->sliderbg3!="-")

                <img width="100" src="{{ asset('assets/images/bg/') }}/{{ $mobiles->sliderbg3 }}">
        @else
                <img src="{{ asset('assets/images') }}/nosignal.jpg" width="100">
        @endif
        </div>
        
                            
                                <div class="row">
                                    <div class="input-field col s12">
                                        Background Slider 1* <input type="file" name="file1">
                                        @if($mobiles->sliderbg1!="") 
                                        <input type='hidden' id='sliderbg1' name='sliderbg1' value="{{ $mobiles->sliderbg1 }}"/>
                                        @else 
                                        <input type='hidden' id='sliderbg1' name='sliderbg1' value="-"/>
                                        @endif
                                    </div>
                                     <div class="input-field col s12">
                                        Background Slider 2* <input type="file" name="file2">
                                         @if($mobiles->sliderbg2!="") 
                                        <input type='hidden' id='sliderbg2' name='sliderbg2' value="{{ $mobiles->sliderbg2 }}"/>
                                        @else 
                                        <input type='hidden' id='sliderbg2' name='sliderbg2' value="-"/>
                                        @endif
                                    </div>
                                     <div class="input-field col s12">
                                        Background Slider 3* <input type="file" name="file3">
                                         @if($mobiles->sliderbg3!="") 
                                        <input type='hidden' id='sliderbg3' name='sliderbg3' value="{{ $mobiles->sliderbg3 }}"/>
                                        @else 
                                        <input type='hidden' id='sliderbg3' name='sliderbg3' value="-"/>
                                        @endif
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">

                    <div class="card">
                         <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Sidebar</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                          
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="sdb2_jdl">Sidebar</label>
                                        <input id="sdb2_jdl" type="text" name="sdb2_jdl" placeholder="Judul Sidebar" value="{{ $mobiles->sdb2_jdl }}" data-error=".sdb2_jdl">
                                        <input id="sdb2_des" type="text" name="sdb2_des" placeholder="Deskripsi Sidebar" value="{{ $mobiles->sdb2_des }}" data-error=".sdb2_des">
                                        <div class="sdb2_jdl">
                                            @if($errors->has('sdb2_jdl'))<div class="error">{{ $errors->first('sdb2_jdl') }}</div>@endif
                                        </div>
                                        <div class="sdb2_des">
                                            @if($errors->has('sdb2_des'))<div class="error">{{ $errors->first('sdb2_des') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Banner</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <div class="col m2" style="width:103px;height:60px;">
            @if($mobiles->banner1!="-")
                <img src="{{ asset('assets/images/banner/') }}/{{ $mobiles->banner1 }}" width="100">
        @else
                <img src="{{ asset('assets/images') }}/noimage.jpg" width="70">
        @endif

        </div>

        <div class="col m2" style="width:103px;height:60px;">
            @if($mobiles->banner2!="-")
                <img src="{{ asset('assets/images/banner/') }}/{{ $mobiles->banner2 }}" width="100">
        @else
                <img src="{{ asset('assets/images') }}/noimage.jpg" width="70" >
        @endif
        </div>

                             
                                <div class="input-field col s12">
                                        Banner 1* <input type="file" name="filebanner1">
                                         @if($mobiles->banner1!="") 
                                        <input type='hidden' id='banner1' name='banner1' value="{{ $mobiles->banner1 }}"/>
                                        @else 
                                        <input type='hidden' id='banner1' name='banner1' value="-"/>
                                        @endif
                                </div>
                                <div class="input-field col s12">
                                        Banner 2* <input type="file" name="filebanner2">
                                         @if($mobiles->banner2!="") 
                                        <input type='hidden' id='banner2' name='banner2' value="{{ $mobiles->banner2 }}"/>
                                        @else 
                                        <input type='hidden' id='banner2' name='banner2' value="-"/>
                                        @endif
                                </div>
                                
                             </form>   
                   </div>
                    </div>

                </div>         
                
            </div>

   
        <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right" type="submit" name="but_upload">
                                           Simpan<i class="mdi-action-swap-vert left"></i>
                                        </button>
                                    </div>
                                </div>
                               
    </div>
</form>
@endsection

@section('script')
    <script>
        $("#mobile").validate({
            rules: {
                
                 slider_jdl1: {
                    required: true
                },
                 slider_jdl2: {
                    required: true
                },
                 slider_jdl3: {
                    required: true
                },
                 sdb2_jdl: {
                    required: true
                },
                 sdb2_des: {
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
    </script>
@endsection
