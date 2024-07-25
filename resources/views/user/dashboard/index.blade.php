@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.dashboard'))

@section('css')
    <link href="{{ asset('assets/css/materialize-colorpicker.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.dashboard') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li class="active">{{ trans('messages.mainapp.menu.dashboard') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="card-stats">
            @can('access', \App\Models\User::class)
                <div class="row">
                    <div class="col s12 m6 l3">
                        <div class="card hoverable">
                            <div class="card-content light-blue darken-2 white-text">
                                <p class="card-stats-title truncate"><i class="mdi-social-group-add"></i> {{ trans('messages.today_queue') }}</p>
                                <h4 class="card-stats-number">{{ $today_queue }}</h4>
                                </p>
                            </div>
                            <div class="card-action light-blue darken-4">
                                <div class="center-align">
                                    <a href="{{ route('reports::queue_list', ['date' => \Carbon\Carbon::now()->format('d-m-Y')]) }}" style="text-transform:none;color:#fff">{{ trans('messages.more_info') }} <i class="mdi-navigation-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card hoverable">
                            <div class="card-content green lighten-1 white-text">
                                <p class="card-stats-title truncate"><i class="mdi-communication-call-missed"></i> {{ trans('messages.today_missed') }}</p>
                                <h4 class="card-stats-number">{{ $missed }}</h4>
                                </p>
                            </div>
                            <div class="card-action green darken-2">
                                <div class="center-align">
                                    <a href="{{ route('reports::missed_show', ['date' => \Carbon\Carbon::now()->format('d-m-Y'), 'user' => 'all', 'counter' => 'all', 'type' => 'missed']) }}" style="text-transform:none;color:#fff">{{ trans('messages.more_info') }} <i class="mdi-navigation-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card hoverable">
                            <div class="card-content blue-grey white-text">
                                <p class="card-stats-title truncate"><i class="mdi-action-trending-up"></i> {{ trans('messages.today_served') }}</p>
                                <h4 class="card-stats-number">{{ $served }}</h4>
                                </p>
                            </div>
                            <div class="card-action blue-grey darken-2">
                                <div class="center-align">
                                    <a href="{{ route('reports::missed_show', ['date' => \Carbon\Carbon::now()->format('d-m-Y'), 'user' => 'all', 'counter' => 'all', 'type' => 'all']) }}" style="text-transform:none;color:#fff">{{ trans('messages.more_info') }} <i class="mdi-navigation-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card hoverable">
                            <div class="card-content orange darken-2 white-text">
                                <p class="card-stats-title truncate"><i class="mdi-image-timer"></i> {{ trans('messages.over_time') }}</p>
                                <h4 class="card-stats-number">{{ $overtime }}</h4>
                                </p>
                            </div>
                            <div class="card-action orange darken-4">
                                <div class="center-align">
                                    <a href="{{ route('reports::missed_show', ['date' => \Carbon\Carbon::now()->format('d-m-Y'), 'user' => 'all', 'counter' => 'all', 'type' => 'overtime']) }}" style="text-transform:none;color:#fff">{{ trans('messages.more_info') }} <i class="mdi-navigation-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('access', \App\Models\User::class)
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="card-panel hoverable waves-effect waves-dark teal lighten-3 white-text" style="display:inherit">
                            <span class="chart-title">{{ trans('messages.queue_details') }}</span>
                            <div class="trending-line-chart-wrapper">
                                <canvas id="queue-details-chart" height="155" style="height:308px"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="card-panel hoverable waves-effect waves-dark" style="display:inherit">
                            <span class="chart-title">{{ trans('messages.today_yesterday') }}</span>
                            <div class="trending-line-chart-wrapper">
                                <canvas id="today-vs-yesterday-chart" height="155" style="height:308px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="row">
                <div class="col s12">
                    <div class="card hoverable waves-effect waves-dark" style="display:inherit">
                        <div class="card-move-up blue-grey white-text">
                            <div class="move-up">
                                <div>
                                    <span class="chart-title">Pengaturan Teks Berjalan</span>
                                </div>
                                <div class="trending-line-chart-wrapper">
                                    <p>{{ trans('messages.dashboard.preview') }}:</p>
                                    <span style="font-size:{{ $setting->size }}px;color:{{ $setting->color }}">
                                        <marquee>{{ $setting->notification }}</marquee>
                                    </span>
                                    <p></p>
                                    <form id="noti" action="{{ route('dashboard_store') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="input-field col s12 m5">
                                                <label for="notification">{{ trans('messages.dashboard.notification_text') }}</label>
                                                <input id="notification" name="notification" type="text" placeholder="{{ trans('messages.dashboard.notification_placeholder') }}" data-error=".errorNotification" value="{{ $setting->notification }}">
                                                <div class="errorNotification"></div>
                                            </div>
                                            <div class="input-field col s12 m1">
                                                <label for="size">{{ trans('messages.font_size') }}</label>
                                                <input id="size" name="size" type="number" placeholder="Size" max="60" min="15" size="2" data-error=".errorSize" value="{{ $setting->size }}">
                                                <div class="errorSize"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="color">{{ trans('messages.color') }}</label>
                                                <input id="color" type="text" placeholder="Color" name="color" data-error=".errorColor" value="{{ $setting->color }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="background_text">Background Teks</label>
                                                <input id="background_text" type="text" placeholder="Background Color" name="background_text" data-error=".errorColor" value="{{ $setting->background_text }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <button class="btn waves-effect waves-light right submit" style="background:{{ $setting->background_menu }};" type="submit" style="padding:0 1.3rem">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="card hoverable waves-effect waves-dark" style="display:inherit">
                        <div class="card-move-up blue-grey white-text">
                            <div class="move-up">
                                <div>
                                    <span class="chart-title">Style Antrian</span>
                                </div>
                                <div class="trending-line-chart-wrapper">
                                   
                                    <form id="noti" action="{{ route('dashboard_style') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">

                                             <div class="input-field col s12 m2">
                                                <label for="background_menu">Background Menu</label>
                                                <input id="background_menu" type="text" placeholder="Background Menu" name="background_menu" data-error=".errorColor" value="{{ $setting->background_menu }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="size_company">Ukuran Teks Print</label>
                                                <input id="size_company" name="size_company" type="number" placeholder="Ukuran Teks Print" max="60" min="15" size="2" value="{{ $setting->size_company }}">
                                                <div class="errorSize"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="size_text_tombol">Ukuran Teks Tombol</label>
                                                <input id="size_text_tombol" name="size_text_tombol" type="number" placeholder="Ukuran Teks Tombol" max="60" min="15" size="2" value="{{ $setting->size_text_tombol }}">
                                                <div class="errorSize"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="size_logo_print">Ukuran Logo Print</label>
                                                <input id="size_logo_print" name="size_logo_print" type="number" placeholder="Ukuran Logo Print" max="600" min="15" size="2" value="{{ $setting->size_logo_print }}">
                                                <div class="errorSize"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="size_logo">Ukuran Logo Display</label>
                                                <input id="size_logo" name="size_logo" type="number" placeholder="Ukuran Logo Display" max="600" min="15" size="2" value="{{ $setting->size_logo }}">
                                                <div class="errorSize"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <button class="btn waves-effect waves-light right submit" style="background:{{ $setting->background_menu }};" type="submit" style="padding:0 1.3rem">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="card hoverable waves-effect waves-dark" style="display:inherit">
                        <div class="card-move-up blue-grey white-text">
                            <div class="move-up">
                                <div>
                                    <span class="chart-title">Pengaturan Style Display</span>
                                </div>
                                <div class="trending-line-chart-wrapper">
                                   
                                    <form id="noti" action="{{ route('dashboard_style_display') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">

                                             <div class="input-field col s12 m2">
                                                <label for="background_panel_aa">Background Panel-AA</label>
                                                <input id="background_panel_aa" type="text" placeholder="Background Panel-AA" name="background_panel_aa" data-error=".errorColor" value="{{ $setting->background_panel_aa }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="background_panel_ab">Background Panel-AB</label>
                                                <input id="background_panel_ab" type="text" placeholder="Background Panel-AB" name="background_panel_ab" data-error=".errorColor" value="{{ $setting->background_panel_ab }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="background_panel_ba">Background Panel-BA</label>
                                                <input id="background_panel_ba" type="text" placeholder="Background Panel-BA" name="background_panel_ba" data-error=".errorColor" value="{{ $setting->background_panel_ba }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="background_panel_bb">Background Panel-BB</label>
                                                <input id="background_panel_bb" type="text" placeholder="Background Panel-BB" name="background_panel_bb" data-error=".errorColor" value="{{ $setting->background_panel_bb }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="background_panel_ca">Background Panel-CA</label>
                                                <input id="background_panel_ca" type="text" placeholder="Background Panel-CA" name="background_panel_ca" data-error=".errorColor" value="{{ $setting->background_panel_ca }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="background_panel_cb">Background Panel-CB</label>
                                                <input id="background_panel_cb" type="text" placeholder="Background Panel-CB" name="background_panel_cb" data-error=".errorColor" value="{{ $setting->background_panel_cb }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="background_panel_da">Background Panel-DA</label>
                                                <input id="background_panel_da" type="text" placeholder="Background Panel-DA" name="background_panel_da" data-error=".errorColor" value="{{ $setting->background_panel_da }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="background_panel_db">Background Panel-DB</label>
                                                <input id="background_panel_db" type="text" placeholder="Background Panel-DB" name="background_panel_db" data-error=".errorColor" value="{{ $setting->background_panel_db }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="color_teks_layanan">Warna Teks Layanan</label>
                                                <input id="color_teks_layanan" type="text" placeholder="Warna Teks Layanan" name="color_teks_layanan" data-error=".errorColor" value="{{ $setting->color_teks_layanan }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="color_teks_loket">Warna Teks Loket</label>
                                                <input id="color_teks_loket" type="text" placeholder="Warna Teks Loket" name="color_teks_loket" data-error=".errorColor" value="{{ $setting->color_teks_loket }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="color_teks_noangka">Warna No & Angka Antrian</label>
                                                <input id="color_teks_noangka" type="text" placeholder="Warna No & Angka Antrian" name="color_teks_noangka" data-error=".errorColor" value="{{ $setting->color_teks_noangka }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <button class="btn waves-effect waves-light right submit" style="background:{{ $setting->background_menu }};" type="submit" style="padding:0 1.3rem">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/materialize-colorpicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/chartjs/chart.min.js') }}"></script>
     
    <script type="text/javascript">
      @if($user->role == 'C')
      window.location = "stafchat";
      @endif

      @if($user->role == 'S')
      window.location = "calls";
      @endif

    </script>
    
    <script>
        $(function() {
            $('#color').colorpicker();
            $('#background_text').colorpicker();
            $('#background_menu').colorpicker();
            $('#background_panel_aa').colorpicker();
            $('#background_panel_ab').colorpicker();
            $('#background_panel_ba').colorpicker();
            $('#background_panel_bb').colorpicker();
            $('#background_panel_ca').colorpicker();
            $('#background_panel_cb').colorpicker();
            $('#background_panel_da').colorpicker();
            $('#background_panel_db').colorpicker();
            $('#color_teks_layanan').colorpicker();
            $('#color_teks_loket').colorpicker();
            $('#color_teks_noangka').colorpicker();
        });
         
        @can('access', \App\Models\User::class)
            $("#noti").validate({
                rules: {
                    notification: {
                        required: true,
                        minlength: 5
                    },
                    size: {
                        required: true,
                        digits: true
                    },
                    color: {
                        required: true
                    },
                    background_panel_aa: {
                        required: true
                    }

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

           $(function() {
                var todayVsYesterdayCartData = {
                    labels: [@foreach ($counters as $indx => $counter)
                            @if($indx==0) <?php echo "'$counter->name $counter->idcounter'"; ?>
                            @else <?php echo ", '$counter->name $counter->idcounter'"; ?>
                            @endif
                        @endforeach],
                    datasets: [
                      {
                          label: "Today",
                          fillColor: "rgba(0,176,159,0.75)",
                          strokeColor: "rgba(220,220,220,0.75)",
                          highlightFill: "rgba(0,176,159,0.9)",
                          highlightStroke: "rgba(220,220,220,9)",
                          data: [@foreach ($today_calls as $indx => $today_call)
                                  @if($indx==0) <?php echo "'$today_call'"; ?>
                                  @else <?php echo ", '$today_call'"; ?>
                                  @endif
                              @endforeach]
                      },
                      {
                          label: "Yesterday",
                          fillColor: "rgba(151,187,205,0.75)",
                          strokeColor: "rgba(220,220,220,0.75)",
                          highlightFill: "rgba(151,187,205,0.9)",
                          highlightStroke: "rgba(220,220,220,0.9)",
                          data: [@foreach ($yesterday_calls as $indx => $yesterday_call)
                                  @if($indx==0) <?php echo "'$yesterday_call'"; ?>
                                  @else <?php echo ", '$yesterday_call'"; ?>
                                  @endif
                              @endforeach]
                      }
                    ]
                };

                var queueDetailsChartData = [
                  {
                      value: "{{ $today_queue }}",
                      color: "#00c0ef",
                      highlight: "#00c0ef",
                      label: "In Queue"
                  },
                  {
                      value: "{{ $missed }}",
                      color: "#00a65a",
                      highlight: "#00a65a",
                      label: "Missed"
                  },
                  {
                      value: "{{ $served }}",
                      color: "#f39c12",
                      highlight: "#f39c12",
                      label: "Served"
                  },
                  {
                      value: "{{ $overtime }}",
                      color: "#dd4b39",
                      highlight: "#dd4b39",
                      label: "Overtime"
                  }
                ];

                var todayVsYesterdayCart = new Chart($("#today-vs-yesterday-chart").get(0).getContext("2d")).Bar(todayVsYesterdayCartData,{
                    responsive:true
                });

                var queueDetailsChart = new Chart($("#queue-details-chart").get(0).getContext("2d")).Pie(queueDetailsChartData,{
                    responsive:true
                });
            });
        @endcan
    </script>
@endsection
