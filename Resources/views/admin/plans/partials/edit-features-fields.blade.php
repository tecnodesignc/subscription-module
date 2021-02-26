@if($features->count())
    @php
        $oldfeatures = array();
            if(isset($plan->features) && $plan->features->count()>0){
                foreach ($plan->features as $feature){
                           $oldfeatures[$feature->id]=$feature;
                       }
                   }else{
                   $oldfeatures=old('features');
                   }
    @endphp
    @foreach($features as $i=>$feature)
        @include('subscription::admin.plans.partials.fields.edit.'.$feature->present()->fields(),['feature'=>$feature,'oldfeatures'=>$oldfeatures])
    @endforeach
@endif
