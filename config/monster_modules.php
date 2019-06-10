<?php

return [
    'namespace' => 'Modules',
    'paths'     => [
        'modules' => base_path('app/Modules'),
        'assets'  => public_path('modules'),
        'stubs'   => [
            'new_module' => app_path('MonsterCMS/Modules/Stubs/Modules'),
            'migrations' => app_path('MonsterCMS/Modules/Stubs/Migrations'),
            'model' => app_path('MonsterCMS/Modules/Stubs/Models'),
            'controller' => app_path('MonsterCMS/Modules/Stubs/Controllers'),
        ]
    ]
];
