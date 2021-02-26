<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.name") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[name]", trans('subscription::features.form.name')) !!}
        {!! Form::text("{$lang}[name]", old("$lang.name"), ['class' => 'form-control', 'placeholder' => trans('subscription::features.form.name')]) !!}
        {!! $errors->first("$lang.name", '<span class="help-block">:message</span>') !!}
    </div>

    <div class='form-group{{ $errors->has("$lang.description") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[description]", trans('subscription::features.form.description')) !!}
        {!! Form::textarea("{$lang}[description]", old("$lang.description"), ['class' => 'form-control',  'rows' => 3, 'placeholder' => trans('subscription::features.form.description')]) !!}
        {!! $errors->first("$lang.description", '<span class="help-block">:message</span>') !!}
    </div>

    <div class='form-group{{ $errors->has("$lang.price") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[price]", trans('subscription::plans.form.price')) !!}
        <div class="input-group">
            {!! Form::number("{$lang}[price]", old("$lang.price"), ['class' => 'form-control', 'placeholder' => trans('subscription::plans.form.price')]) !!}
            <div class="input-group-addon">$</div>
        </div>
        {!! $errors->first("$lang.price", '<span class="help-block">:message</span>') !!}
    </div>

</div>
