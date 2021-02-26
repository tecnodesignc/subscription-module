<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.name") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[name]", trans('subscription::features.form.name')) !!}
        {!! Form::text("{$lang}[name]", old("$lang.name"), ['class' => 'form-control', 'placeholder' => trans('subscription::features.form.name')]) !!}
        {!! $errors->first("$lang.name", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.caption") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[caption]", trans('subscription::features.form.caption')) !!}
        {!! Form::text("{$lang}[caption]", old("$lang.caption"), ['class' => 'form-control', 'placeholder' => trans('subscription::features.form.caption')]) !!}
        {!! $errors->first("$lang.caption", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.description") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[description]", trans('subscription::features.form.description')) !!}
        {!! Form::textarea("{$lang}[description]", old("$lang.description"), ['class' => 'form-control',  'rows' => 3, 'placeholder' => trans('subscription::features.form.description')]) !!}
        {!! $errors->first("$lang.description", '<span class="help-block">:message</span>') !!}
    </div>



</div>
