<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],


        'employee/photo' => [
            'driver' => 'local',
            'root' => storage_path('app/public/employee/photo'),
        ],

        // faculty director photo

        'faculty/photo' => [
            'driver' => 'local',
            'root' => storage_path('app/public/faculty/photo'),
        ],

        // departments manger photo
        'department/photo' => [
            'driver' => 'local',
            'root' => storage_path('app/public/department/photo'),
        ],

        // user photos
        'users' => [
            'driver' => 'local',
            'root' => storage_path('app/public/users'),
        ],

        // documents
        'document/attachment' => [
            'driver' => 'local',
            'root' => storage_path('app/public/document/attachment'),
        ],


        'plan' => [
            'driver' => 'local',
            'root' => storage_path('app/public/plan'),
        ],

        'pdc/archive' => [
            'driver' => 'local',
            'root' => storage_path('app/public/pdc/archive'),
        ],

        // pdc commites
        'pdc/commit' => [
            'driver' => 'local',
            'root' => storage_path('app/public/pdc/commit'),
        ],

        // teacher attachments in commits
        'pdc/teacher_in_commit' => [
            'driver' => 'local',
            'root' => storage_path('app/public/pdc/teacher_in_commit'),
        ],

        // pdc teacher in commit
        'pdc/commit' => [
            'driver' => 'local',
            'root' => storage_path('app/public/pdc/teacher_in_commit'),
        ],

        //   teacher in scholarship
        'pdc/teacher_in_scholarship' => [
            'driver' => 'local',
            'root' => storage_path('app/public/pdc/teacher_in_scholarship'),
        ],

        // workshops

        'pdc/workshop' => [
            'driver' => 'local',
            'root' => storage_path('app/public/pdc/workshop'),
        ],
        //   teacher in workshops
        'pdc/teacher_in_workshop' => [
            'driver' => 'local',
            'root' => storage_path('app/public/pdc/teacher_in_workshop'),
        ],


        // teachers
        'teacher_photo' => [
            'driver' => 'local',
            'root' => storage_path('app/public/teacher_photo'),
        ],


        // teachers documents
        'teacher_document' => [
            'driver' => 'local',
            'root' => storage_path('app/public/teacher_document'),
        ],

        // teachers documents
        'teacher_promotion' => [
            'driver' => 'local',
            'root' => storage_path('app/public/teacher_promotion'),
        ],

        // Quality assurance main criteria
        'quality_assurance/document' => [
            'driver' => 'local',
            'root' => storage_path('app/public/quality_assurance/document'),
        ],
        // Quality assurance sub criteria
        'quality_assurance/sub_document' => [
            'driver' => 'local',
            'root' => storage_path('app/public/quality_assurance/sub_document'),
        ],

        'quality_assurance/archive' => [
            'driver' => 'local',
            'root' => storage_path('app/public/quality_assurance/archive'),
        ],

        // Graduated program
        'postgraduated/student_research' => [
            'driver' => 'local',
            'root' => storage_path('app/public/postgraduated/student_research'),
        ],


        // Research department

        'research_department/teacher_research' => [
            'driver' => 'local',
            'root' => storage_path('app/public/research_department/teacher_research'),
        ],

        'research_department/project_images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/research_department/project_images'),
        ],

        'research_department/experiment_details_images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/research_department/experiment_details_images'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
