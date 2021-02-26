<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[name]", trans('subscription::products.form.name')) !!}
        {!! Form::text("{$lang}[name]", old("$lang.name"), ['class' => 'form-control', 'placeholder' => trans('subscription::products.form.name')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>

    @editor('description', trans('subscription::products.form.description'), old("{$lang}.description"), $lang)

   {{-- @if (config('encore.blog.config.post.partials.translatable.create') !== [])
        @foreach (config('encore.blog.config.post.partials.translatable.create') as $partial)
            @include($partial)
        @endforeach
    @endif--}}
</div>
