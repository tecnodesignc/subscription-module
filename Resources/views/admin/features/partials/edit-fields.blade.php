<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.name") ? ' has-error' : '' }}'>
        @php $oldName = $feature->translate($lang)->name ?? ''@endphp
        {!! Form::label("{$lang}[name]", trans('subscription::features.form.name')) !!}
        {!! Form::text("{$lang}[name]", old("$lang.name",$oldName), ['class' => 'form-control', 'placeholder' => trans('subscription::features.form.name')]) !!}
        {!! $errors->first("$lang.name", '<span class="help-block">:message</span>') !!}
    </div>

    <div class='form-group{{ $errors->has("$lang.caption") ? ' has-error' : '' }}'>
        @php $oldCaption = $feature->translate($lang)->caption ?? ''@endphp
        {!! Form::label("{$lang}[caption]", trans('subscription::features.form.caption')) !!}
        {!! Form::text("{$lang}[caption]", old("$lang.caption",$oldCaption), ['class' => 'form-control', 'placeholder' => trans('subscription::features.form.caption')]) !!}
        {!! $errors->first("$lang.caption", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.description") ? ' has-error' : '' }}'>
        @php $oldDescription = $feature->translate($lang)->description ?? ''@endphp
        {!! Form::label("{$lang}[description]", trans('subscription::features.form.description')) !!}
        {!! Form::textarea("{$lang}[description]", old("$lang.description",$oldDescription), ['class' => 'form-control',  'rows' => 3, 'placeholder' => trans('subscription::features.form.description')]) !!}
        {!! $errors->first("$lang.description", '<span class="help-block">:message</span>') !!}
    </div>

</div>
