<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.name") ? ' has-error' : '' }}'>
        @php $oldName = $product->translate($lang)->name ?? ''@endphp
        {!! Form::label("{$lang}[name]", trans('subscription::products.form.name')) !!}
        {!! Form::text("{$lang}[name]", old("$lang.name",$oldName), ['class' => 'form-control', 'placeholder' => trans('subscription::products.form.name')]) !!}
        {!! $errors->first("$lang.name", '<span class="help-block">:message</span>') !!}
    </div>
    @php $oldDescription = $product->translate($lang)->description ?? ''@endphp
    @editor('description', trans('subscription::products.form.description'), old("{$lang}.description",$oldDescription), $lang)

    {{-- @if (config('encore.blog.config.post.partials.translatable.create') !== [])
         @foreach (config('encore.blog.config.post.partials.translatable.create') as $partial)
             @include($partial)
         @endforeach
     @endif--}}

</div>
