@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('subscription::features.title.features') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.subscription.product.index') }}">{{ trans('subscription::products.title.products') }}</a></li>
        <li class="active">{{ trans('subscription::features.title.features') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.subscription.feature.create',[$product_id]) }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('subscription::features.button.create feature') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('subscription::features.table.id') }}</th>
                                <th>{{ trans('subscription::features.table.name') }}</th>
                                <th>{{ trans('subscription::features.table.caption') }}</th>
                                <th>{{ trans('subscription::features.table.unit') }}</th>
                                <th>{{ trans('subscription::features.table.status') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('subscription::common.table.updated at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($features))
                                @foreach ($features as $feature)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.subscription.feature.edit', [$product_id,$feature->id]) }}">
                                                {{ $feature->id }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.feature.edit', [$product_id,$feature->id]) }}">
                                                {{ $feature->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.feature.edit', [$product_id,$feature->id]) }}">
                                                {{ $feature->caption }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.feature.edit', [$product_id,$feature->id]) }}">
                                                {{ $feature->unit }}
                                            </a>
                                        </td>

                                        <td>
                                            <span class="label {{ $feature->present()->statusLabelClass}}">
                                            {{ $feature->present()->status}}
                                    </span>

                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.feature.edit', [$product_id,$feature->id]) }}">
                                                {{ $feature->created_at }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.feature.edit', [$product_id,$feature->id]) }}">
                                                {{ $feature->updated_at }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.subscription.feature.edit', [$product_id,$feature->id]) }}"
                                                   class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                                <button class="btn btn-danger btn-flat" data-toggle="modal"
                                                        data-target="#modal-delete-confirmation"
                                                        data-action-target="{{ route('admin.subscription.feature.destroy', [$product_id,$feature->id]) }}">
                                                    <i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('subscription::features.table.id') }}</th>
                                <th>{{ trans('subscription::features.table.name') }}</th>
                                <th>{{ trans('subscription::features.table.caption') }}</th>
                                <th>{{ trans('subscription::features.table.unit') }}</th>
                                <th>{{ trans('subscription::features.table.status') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('subscription::common.table.updated at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('subscription::features.title.create feature') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.subscription.feature.create',[$product_id]) ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "asc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
