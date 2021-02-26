@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('subscription::plans.title.plans') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.subscription.product.index') }}">{{ trans('subscription::products.title.products') }}</a></li>
        <li class="active">{{ trans('subscription::plans.title.plans') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.subscription.plan.create',[$product_id]) }}" class="btn btn-info btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('subscription::plans.button.create plan') }}
                    </a>
                    <a href="{{ route('admin.subscription.feature.index', [$product_id]) }}" class="btn btn-primary btn-flat" style="padding: 4px 10px; margin: 0 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('subscription::features.title.features') }}
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
                                <th>{{ trans('subscription::plans.table.id') }}</th>
                                <th>{{ trans('subscription::plans.table.name') }}</th>
                                <th>{{ trans('subscription::plans.table.price') }}</th>
                                <th>{{ trans('subscription::plans.table.bill cycle') }}</th>
                                <th>{{ trans('subscription::plans.table.status') }}</th>
                                <th>{{ trans('subscription::plans.table.Display Order') }}</th>
                                <th>{{ trans('subscription::plans.table.Free Plan') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($plans))
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.subscription.plan.edit', [$product_id, $plan->id]) }}">
                                                {{ $plan->id }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.plan.edit', [$product_id, $plan->id]) }}">
                                                {{ $plan->name}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.plan.edit', [$product_id, $plan->id]) }}">
                                                $ {{number_format($plan->price,2,'.',' ')}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.plan.edit', [$product_id, $plan->id]) }}">
                                                {{ $plan->bill_cycle}}
                                            </a>
                                        </td>
                                        <td>
                                          <span class="label {{ $plan->present()->statusLabelClass}}">
                                                {{ $plan->present()->status}}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.plan.edit', [$product_id, $plan->id]) }}">
                                                {{ $plan->display_order}}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.subscription.plan.edit', [$product_id, $plan->id]) }}" >
                                                <i class="fa fa-check-circle-o {{ $plan->free?'text-green':'text-gray' }}"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.plan.edit', [$product_id, $plan->id]) }}">
                                                {{ $plan->created_at }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.subscription.plan.edit', [$product_id, $plan->id]) }}"
                                                   class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                                <button class="btn btn-danger btn-flat" data-toggle="modal"
                                                        data-target="#modal-delete-confirmation"
                                                        data-action-target="{{ route('admin.subscription.plan.destroy', [$product_id, $plan->id]) }}">
                                                    <i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('subscription::plans.table.id') }}</th>
                                <th>{{ trans('subscription::plans.table.name') }}</th>
                                <th>{{ trans('subscription::plans.table.price') }}</th>
                                <th>{{ trans('subscription::plans.table.bill cycle') }}</th>
                                <th>{{ trans('subscription::plans.table.status') }}</th>
                                <th>{{ trans('subscription::plans.table.Display Order') }}</th>
                                <th>{{ trans('subscription::plans.table.Free Plan') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
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
        <dd>{{ trans('subscription::plans.title.create plan') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.subscription.plan.create',[$product_id]) ?>" }
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
                "order": [[ 5, "asc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
