<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.name") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[name]", trans('subscription::features.form.name')) !!}
        @php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->name : '' @endphp
        {!! Form::text("{$lang}[name]", old("$lang.name",$old), ['class' => 'form-control', 'placeholder' => trans('subscription::features.form.name')]) !!}
        {!! $errors->first("$lang.name", '<span class="help-block">:message</span>') !!}
    </div>

    <div class='form-group{{ $errors->has("$lang.description") ? ' has-error' : '' }}'>
        @php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->description : '' @endphp
        {!! Form::label("{$lang}[description]", trans('subscription::features.form.description')) !!}
        {!! Form::textarea("{$lang}[description]", old("$lang.description",$old), ['class' => 'form-control',  'rows' => 3, 'placeholder' => trans('subscription::features.form.description')]) !!}
        {!! $errors->first("$lang.description", '<span class="help-block">:message</span>') !!}
    </div>

    <div class='form-group{{ $errors->has("$lang.price") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[price]", trans('subscription::plans.form.price')) !!}
        @php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->price : '' @endphp
        <div class="input-group">
            {!! Form::number("{$lang}[price]", old("$lang.price",$old), ['class' => 'form-control', 'placeholder' => trans('subscription::plans.form.price')]) !!}
            <div class="input-group-addon">$</div>
        </div>
        {!! $errors->first("$lang.price", '<span class="help-block">:message</span>') !!}
    </div>

</div>
