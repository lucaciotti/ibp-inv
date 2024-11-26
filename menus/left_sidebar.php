<?php

$leftSidebar = [
    [
        'text'        => 'Home',
        'url'         => 'home',
        'icon'        => 'fas fa-fw fa-home',
    ],

    [
        'header' => 'Inventario Semplificato',
        'classes'  => 'text-bold text-center',
        'laratrust'  => ['completed-read'],
    ],
    [
        'text'        => ' Misurazioni Inventario',
        'url'         => 'inventory/measurements_simple',
        'icon'        => 'fas fa-tasks',
        'laratrust'  => ['completed-read'],
    ],
    [
        'text'        => ' Gestione Inventario',
        'url'         => 'inventory/stats_simple',
        'icon'        => 'fas fa-chart-bar',
        'laratrust'  => ['users-create'],
    ],

    // [
    //     'header' => 'Inventario Avanzato',
    //     'classes'  => 'text-bold text-center',
    //     'laratrust'  => ['users-create'],
    // ],
    // [
    //     'text'        => ' Misurazioni Inventario Avanz.',
    //     'url'         => 'inventory/measurements',
    //     'icon'        => 'fas fa-tasks',
    //     'laratrust'  => ['users-create'],
    // ],
    // [
    //     'text'        => ' Gestione Inventario Avanz.',
    //     // 'url'         => 'inventory/stats',
    //     'url'         => '#',
    //     'icon'        => 'fas fa-chart-bar',
    //     'laratrust'  => ['users-create'],
    // ],
    // [
    //     'text'        => ' Tagliandini Inventario',
    //     'url'         => 'inventory/tickets',
    //     'icon'        => 'fas fa-barcode',
    //     'laratrust'  => ['users-create'],
    // ],

    [
        'header' => 'Anagrafiche',
        'classes'  => 'text-bold text-center',
        'laratrust'  => ['users-create'],
    ],
    [
        'text'        => ' Prodotti',
        'url'         => 'products',
        'icon'        => 'fas fa-boxes',
        'laratrust'  => ['users-create'],
    ],
    [
        'text'        => ' Magazzini & Ubicazioni',
        'url'         => 'warehouses',
        'icon'        => 'fas fa-warehouse',
        'laratrust'  => ['users-create'],
    ],
    [
        'header' => 'Configurazioni',
        'classes'  => 'text-bold text-center',
        'laratrust'  => ['users-create'],
    ],
    [
        'text'        => ' Sessione Inventario',
        'url'         => 'config/inventory/sesions',
        'icon'        => 'fas fa-dolly-flatbed',
        'laratrust'  => ['users-create'],
    ],

];
