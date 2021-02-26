@php
    $old =$oldfeatures[$feature->id]??[]@endphp
<div class='form-group{{ $errors->has("features.[$feature->id].value") ? ' has-error' : '' }}'>
    <label class="checkbox-inline"
           for="features[{{$feature->id}}][value])">
        <input type="hidden" id="features[{{$feature->id}}][value]" name="features[{{$feature->id}}][value]" value="false">
    <input type="checkbox" id="features[{{$feature->id}}][value]" name="features[{{$feature->id}}][value]"
           value="true" {{old("features.$feature->id.value",$old->items->value??'')==='1'?'checked':''}}>
    {{$feature->name}}
    {!! $errors->first("features.$feature->id.value", '<span class="help-block">:message</span>') !!}
</div>
<div class='form-group{{ $errors->has("features.$feature->id.plan_caption") ? ' has-error' : '' }}'>
    {!! Form::text("features[{$feature->id}][plan_caption]", old("features.$feature->id.plan_caption",$old->items->plan_caption??''), ['class' => 'form-control']) !!}
    <div class="text-muted text-sm">{{trans('subscription::plans.form.feature caption')}}</div>
    {!! $errors->first("features.$feature->id.plan_caption", '<span class="help-block">:message</span>') !!}
</div>
