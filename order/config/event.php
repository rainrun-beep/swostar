<?php
return [
    "listeners" => [
        [
            "path" => "/app/Listener",
            "namespace" => "App\\Listener\\"
        ],
    ],
    "events" => [
        \App\StopListener::class,
    ]
];
