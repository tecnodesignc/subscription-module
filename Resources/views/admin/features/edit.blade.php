@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('subscription::features.title.edit feature') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                    class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li>
            <a href="{{ route('admin.subscription.product.index') }}">{{ trans('subscription::products.title.products') }}</a>
        </li>
        <li>
            <a href="{{ route('admin.subscription.feature.index',[$product_id]) }}">{{ trans('subscription::features.title.features') }}</a>
        </li>
        <li class="active">{{ trans('subscription::features.title.edit feature') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.subscription.feature.update', [$feature->product_id,$feature->id]], 'method' => 'put']) !!}
    <input type="hidden" name="product_id" value="{{$feature->product_id}}">
    <div class="row">
        <div class="col-md-8">
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
                                            @include('subscription::admin.features.partials.edit-fields', ['lang' => $locale])
                                        </div>
                                    @endforeach
                                </div>
                            </div> {{-- end nav-tabs-custom --}}
                        </div>
                        <div class="box-footer">
                            <button type="submit"
                                    class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                            <a class="btn btn-danger pull-right btn-flat"
                               href="{{ route('admin.subscription.feature.index',[$feature->product_id])}}"><i
                                    class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('subscription::products.form.publish')}}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">

                            <div class='form-group{{ $errors->has("active") ? ' has-error' : '' }}'>
                                <div>
                                    <label>{{trans('subscription::common.form.status')}}</label>
                                </div>
                                <label class="radio-inline" for="{{trans('subscription::common.form.inactive')}}">
                                    <input type="radio" id="status" name="active"
                                           value="0" {{$feature->active == 0 ? 'checked':''}}>
                                    {{trans('subscription::common.form.inactive')}}
                                </label>
                                <label class="radio-inline" for="{{trans('subscription::common.form.active')}}">
                                    <input type="radio" id="status" name="active"
                                           value="1" {{$feature->active == 1 ? 'checked':''}}>
                                    {{trans('subscription::common.form.active')}}
                                </label>
                            </div>
                            <div class='form-group{{ $errors->has("type") ? ' has-error' : '' }}'>
                                {!! Form::label("type", trans('subscription::features.form.type')) !!}
                                <select name="type" id="type" class="form-control">
                                    <option>{{trans('subscription::types.type selection')}}</option>
                                    <option
                                        value="0" {{$feature->type == 0 ? 'selected':''}}>{{ trans('subscription::types.quantity')}}</option>
                                    <option
                                        value="1" {{$feature->type == 1 ? 'selected':''}}>{{trans('subscription::types.text')}}</option>
                                    <option
                                        value="2" {{$feature->type == 2 ? 'selected':''}}>{{trans('subscription::types.boolean')}}</option>
                                </select>
                                {!! $errors->first("type", '<span class="help-block">:message</span>') !!}
                            </div>
                            @php $oldUnit = $feature->unit ?? ''@endphp
                            <div class='form-group{{ $errors->has("unit") ? ' has-error' : '' }}'>
                                {!! Form::label("unit", trans('subscription::features.form.unit')) !!}
                                {!! Form::text("unit", old("unit", $oldUnit), ['class' => 'form-control', 'placeholder' => trans('subscription::features.form.unit')]) !!}
                                {!! $errors->first("unit", '<span class="help-block">:message</span>') !!}
                            </div>

                        </div>
                    </div>
                </div>
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
                    {key: 'b', route: "<?= route('admin.subscription.feature.index',[$product_id]) ?>"}
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
