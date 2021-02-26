<?php

return [
    'name' => 'Subscription',
    'products' => [
        /**
         * |--------------------------------------------------------------------------
         * | Partials to include on page views
         * |--------------------------------------------------------------------------
         * | List the partials you wish to include on the different type page views
         * | The content of those fields well be caught by the PostWasCreated and PostWasEdited events
         */
        'partials' => [
            'translatable' => [
                'create' => [],
                'edit' => [],
            ],
            'normal' => [
                'create' => [],
                'edit' => [],
            ],
        ],
        /**
         * |--------------------------------------------------------------------------
         * | Array of directories to ignore when selecting the template for a page
         * |--------------------------------------------------------------------------
         */

        /**
         * |--------------------------------------------------------------------------
         * | Dynamic relations
         * |--------------------------------------------------------------------------
         * | Add relations that will be dynamically added to the Post entity
         */
        'relations' => [
            //        'extension' => function ($self) {
            //            return $self->belongsTo(PostExtension::class, 'id', 'post_id')->first();
            //        }
        ],
    ],
];
