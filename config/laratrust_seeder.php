<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'tasks' => 'c,r,u,d',
            'config' => 'c,r,u,d',
            'xlsimport' => 'c,r,u,d',
            'completed' => 'c,r,u,d',
        ],
        'manager' => [
            'users' => 'r',
            'tasks' => 'c,r,u',
            'config' => 'c,r,u',
            'xlsimport' => 'c,r,u',
            'completed' => 'c,r,u',
        ],
        'production' => [
            'users' => 'r',
            'tasks' => 'r,u',
            'config' => 'r',
            'xlsimport' => 'r',
            'completed' => 'r',
        ],
        'user' => [
            'tasks' => 'r',
            'xlsimport' => 'r',
            'completed' => 'r',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
