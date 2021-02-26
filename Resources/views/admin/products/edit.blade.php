@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('subscription::products.title.edit product') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.subscription.product.index') }}">{{ trans('subscription::products.title.products') }}</a></li>
        <li class="active">{{ trans('subscription::products.title.edit product') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.subscription.product.update', $product->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                @include('partials.form-tab-headers', ['fields' => ['name']])
                                <div class="tab-content">
                                    @php $i = 0; @endphp
                                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                                        @php $i++; @endphp
                                        <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}"
                                             id="tab_{{ $i }}">
                                            @include('subscription::admin.products.partials.edit-fields', ['lang' => $locale])
                                            <div class='form-group{{ $errors->has("require_shipping_address") ? ' has-error' : '' }}'>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="1" {{$product->require_shipping_address ? ' checked="checked"':''}}
                                                        name="require_shipping_address" >
                                                        {{trans('subscription::products.form.Require Shipping Address')}}
                                                    </label>
                                                </div>
                                                {!! $errors->first("require_shipping_address", '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div> {{-- end nav-tabs-custom --}}
                        </div>
                    </div>
                </div>
            </div>
          {{-- @if (config('subscription::config.products.partials.normal.create') !== [])
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Adicional</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="nav-tabs-custom">
                                    <div class="tab-content">
                                        @foreach (config('encore.subscription.config.products.partials.normal.create') as $partial)
                                            @include($partial)
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif--}}
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('subscription::products.form.publish')}}:</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class='form-group{{ $errors->has("system_name") ? ' has-error' : '' }}'>
                                                {!! Form::label("system_name", trans('subscription::products.form.system_name')) !!}
                                                {!! Form::text("system_name", old("system_name",$product->system_name), ['class' => 'form-control', 'placeholder' => trans('subscription::products.form.system_name')]) !!}
                                                {!! $errors->first("system_name", '<span class="help-block">:message</span>') !!}
                                            </div>
                                            <div class='form-group{{ $errors->has("active") ? ' has-error' : '' }}'>
                                                <div>
                                                    <label>{{trans('subscription::common.form.status')}}</label>
                                                </div>
                                                <label class="radio-inline" for="{{trans('subscription::common.form.inactive')}}">
                                                    <input type="radio" id="status" name="active" value="0" {{$product->active=='0'?'checked':''}} >
                                                    {{trans('subscription::common.form.inactive')}}
                                                </label>
                                                <label class="radio-inline" for="{{trans('subscription::common.form.active')}}">
                                                    <input type="radio" id="status" name="active" value="1" {{$product->active==1?'checked':''}}>
                                                    {{trans('subscription::common.form.active')}}
                                                </label>
                                            </div>
                                            <div class='input-group date' id='created'>
                                                <input type='text' name="created_at" id="created_at" class="form-control"
                                                       value="{{$product->created_at}}"/>
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-calendar"></span> </span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <button type="submit"
                                            class="btn btn-primary btn-flat">{{ trans('subscription::products.button.edit product') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('subscription::products.form.Featured Image')}}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    @mediaSingle('thumbnail',$product)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('subscription::products.form.autor')}}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <select name="user_id" id="user" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id }}" {{$user->id == $currentUser->id ? 'selected' : ''}}>{{$user->present()->fullname()}}
                                                - ({{$user->email}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    community_manager

    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css"
          integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous"/>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
        integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.subscription.product.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'

            });

            $('.btn-box-tool').click(function (e) {
                e.preventDefault();
            });
        });
    </script>
    <style>

        .nav-tabs-custom > .nav-tabs > li.active {
            border-top-color: white !important;
            border-bottom-color: #3c8dbc !important;
        }

        .nav-tabs-custom > .nav-tabs > li.active > a, .nav-tabs-custom > .nav-tabs > li.active:hover > a {
            border-left: 1px solid #e6e6fd !important;
            border-right: 1px solid #e6e6fd !important;

        }


    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            $(function () {
                var bindDatePicker = function () {
                    $(".date").datetimepicker({
                        format: 'YYYY-MM-DD HH:mm:ss',
                        //defaultDate: $(this).val(),
                        icons: {
                            time: "fa fa-clock-o",
                            date: "fa fa-calendar",
                            up: "fa fa-arrow-up",
                            down: "fa fa-arrow-down"
                        }
                    }).find('input:first').on("blur", function () {
                        // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
                        // update the format if it's yyyy-mm-dd
                        var date = parseDate($(this).val());

                        if (!isValidDate(date)) {
                            //create date based on momentjs (we have that)
                            date = moment().format('YYYY-MM-DD');
                        }

                        $(this).val(date);
                    }).datepicker('update', new Date());
                }

                var isValidDate = function (value, format) {
                    format = format || false;
                    // lets parse the date to the best of our knowledge
                    if (format) {
                        value = parseDate(value);
                    }

                    var timestamp = Date.parse(value);

                    return isNaN(timestamp) == false;
                }

                var parseDate = function (value) {
                    var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
                    if (m)
                        value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

                    return value;
                }

                bindDatePicker();
            });
        });
    </script>
@endpush
