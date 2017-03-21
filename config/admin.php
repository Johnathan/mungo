<?php

return [

    'nav' => [
        [
            'section' => 'Content'
        ],
        [
            'section' => 'Administration',
            'items' => [
                [
                    'title' => 'Users',
                    'route' => 'admin.users.index',
                    'children' => [
                        [
                            'title' => 'Create a User',
                            'route' => 'admin.users.create'
                        ]
                    ]
                ],
                [
                    'title' => 'System Settings',
                    'route' => null,
                    'children' => [
                        [
                            'title' => 'Roles & Permissions',
                            'route' => 'admin.settings.roles.index'
                        ]
                    ]
                ]
            ]
        ]
    ]

];