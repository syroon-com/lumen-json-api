<?php

return [
    /*
     / Mapping for resource types to the corresponding schema class.
     */
    'resources' => [
        /*
         * Example entry:
         * 'resource' => [
         *     'model' => App\Models\Resource::class
         *     'schema' => App\Schemas\Resource::class
         * ],
         * The `model`and `schema` keys are optional. If not provided, the model and schema class names will be created
         * using the resource name.
         */
        'user' => [
            'model' => \App\Models\User::class,
            'schema' => \App\Schemas\User::class,
        ]
    ],
];
