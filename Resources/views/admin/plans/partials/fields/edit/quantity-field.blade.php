@php $old =$oldfeatures[$feature->id]??[]@endphp

<div class='form-group{{ $errors->has("features.[$feature->id].value") ? ' has-error' : '' }}'>
    {!! Form::label("features[{$feature->id}][value]", $feature->name) !!}
    {!! Form::number("features[{$feature->id}][value]", old("features.$feature->id.value",$old->items->value??''), ['class' => 'form-control', 'placeholder' => $feature->name]) !!}
    {!! $errors->first("features.$feature->id.value", '<span class="help-block">:message</span>') !!}
</div>
<div class='form-group{{ $errors->has("features.$feature->id.plan_caption") ? ' has-error' : '' }}'>
    {!! Form::text("features[{$feature->id}][plan_caption]", old("features.$feature->id.plan_caption",$old->items->plan_caption??''), ['class' => 'form-control']) !!}
    <div class="text-muted text-sm">{{trans('subscription::plans.form.feature caption')}}</div>
    {!! $errors->first("features.$feature->id.plan_caption", '<span class="help-block">:message</span>') !!}
</div>
