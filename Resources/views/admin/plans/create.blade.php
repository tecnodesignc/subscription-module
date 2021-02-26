@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('subscription::plans.title.create plan') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                    class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li>
            <a href="{{ route('admin.subscription.plan.index',[$product_id]) }}">{{ trans('subscription::plans.title.plans') }}</a>
        </li>
        <li class="active">{{ trans('subscription::plans.title.create plan') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.subscription.plan.store',[$product_id]], 'method' => 'post']) !!}
    <input type="hidden" name="product_id" value="{{$product_id}}">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                @include('partials.form-tab-headers')
                                <div class="tab-content">
                                    <?php $i = 0; ?>
                                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                                        <?php $i++; ?>
                                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}"
                                             id="tab_{{ $i }}">
                                            @include('subscription::admin.plans.partials.create-fields', ['lang' => $locale])
                                        </div>
                                    @endforeach
                                    <div class="box-body">
                                        <div class='form-group{{ $errors->has("code") ? ' has-error' : '' }}'>
                                            {!! Form::label("code", trans('subscription::plans.form.code')) !!}
                                            {!! Form::text("code", old("code"), ['class' => 'form-control', 'placeholder' => trans('subscription::plans.form.code')]) !!}
                                            {!! $errors->first("code", '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <h3>{{trans('subscription::plans.form.count')}}</h3>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div
                                                    class='form-group{{ $errors->has("frequency") ? ' has-error' : '' }}'>
                                                    {!! Form::label("frequency", trans('subscription::plans.form.frequency')) !!}
                                                    {!! Form::number("frequency", old("frequency",1), ['class' => 'form-control', 'placeholder' => trans('subscription::plans.form.frequency')]) !!}
                                                    {!! $errors->first("frequency", '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div
                                                    class='form-group{{ $errors->has("bill_cycle") ? ' has-error' : '' }}'>
                                                    {!! Form::label("bill_cycle", trans('subscription::plans.form.bill-cycle.title')) !!}
                                                    <select class="form-control" name="bill_cycle" id="bill_cycle">
                                                        <option>{{trans('subscription::types.type selection')}}</option>
                                                        <option
                                                            value="week">{{ trans('subscription::plans.form.bill-cycle.weeks')}}</option>
                                                        <option
                                                            value="month">{{trans('subscription::plans.form.bill-cycle.months')}}</option>
                                                        <option
                                                            value="year">{{trans('subscription::plans.form.bill-cycle.years')}}</option>
                                                    </select>
                                                    {!! $errors->first("bill_cycle", '<span class="help-block">:message</span>') !!}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <p>
                                                    {{trans('subscription::plans.form.Bill cycle will be every 2 Months')}}
                                                </p>
                                            </div>


                                        </div>
                                        <div class='form-group{{ $errors->has("trial_period") ? ' has-error' : '' }}'>
                                            {!! Form::label("trial_period", trans('subscription::plans.form.trial_period')) !!}
                                            {!! Form::number("trial_period", old("trial_period",0), ['class' => 'form-control', 'placeholder' => trans('subscription::plans.form.trial_period')]) !!}
                                            {!! $errors->first("trial_period", '<span class="help-block">:message</span>') !!}
                                            <div class="text-muted text-sm">
                                                {{trans('subscription::plans.form.help-trial-period')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- end nav-tabs-custom --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class='form-group{{ $errors->has("active") ? ' has-error' : '' }}'>
                                        <div>
                                            <label>{{trans('subscription::common.form.status')}}</label>
                                        </div>
                                        <label class="radio-inline"
                                               for="{{trans('subscription::common.form.inactive')}}">
                                            <input type="radio" id="status" name="active" value="0" checked>
                                            {{trans('subscription::common.form.inactive')}}
                                        </label>
                                        <label class="radio-inline" for="{{trans('subscription::common.form.active')}}">
                                            <input type="radio" id="status" name="active" value="1">
                                            {{trans('subscription::common.form.active')}}
                                        </label>
                                    </div>
                                    <div class='form-group{{ $errors->has("display_order") ? ' has-error' : '' }}'>
                                        {!! Form::label("display_order", trans('subscription::plans.form.display_order')) !!}
                                        {!! Form::number("display_order", old("display_order"), ['class' => 'form-control', 'placeholder' => trans('subscription::plans.form.display_order')]) !!}
                                        {!! $errors->first("display_order", '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class='form-group{{ $errors->has("recommendation") ? ' has-error' : '' }}'>
                                        <label class="checkbox-inline"
                                               for="{{trans('subscription::plans.forms.recommendation')}}">
                                            <input type="checkbox" id="recommendation" name="recommendation"
                                                   value="true">
                                            {{trans('subscription::plans.form.recommendation')}}
                                        </label>
                                    </div>
                                    <div class='form-group{{ $errors->has("free") ? ' has-error' : '' }}'>
                                        <label class="checkbox-inline"
                                               for="{{trans('subscription::plans.forms.free')}}">
                                            <input type="checkbox" id="free" name="free" value="true">
                                            {{trans('subscription::plans.form.free')}}
                                        </label>
                                    </div>
                                    <div class='form-group{{ $errors->has("visible") ? ' has-error' : '' }}'>
                                        <label class="checkbox-inline"
                                               for="{{trans('subscription::plans.forms.visible')}}">
                                            <input type="checkbox" id="visible" name="visible" value="1" checked>
                                            {{trans('subscription::plans.form.visible')}}
                                        </label>
                                    </div>
                                </div>
                            </div> {{-- end nav-tabs-custom --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('subscription::plans.form.icon')}}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    @mediaSingle('icon')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    @include('subscription::admin.plans.partials.create-features-fields',$features)
                                </div>
                            </div> {{-- end nav-tabs-custom --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box-footer">
                <button type="submit"
                        class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                <a class="btn btn-danger pull-right btn-flat"
                   href="{{ route('admin.subscription.feature.index',[$product_id])}}"><i
                        class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
            </div>
        </div>
    </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).keypressAction({
                actions: [
                    {key: 'b', route: "<?= route('admin.subscription.plan.index', [$product_id]) ?>"}
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
