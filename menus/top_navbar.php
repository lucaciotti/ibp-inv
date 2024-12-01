<?php

$topNavbar = [
         // Navbar items:
        [
            'text'        => ' APP OMS',
            'url'         => 'https://ibpoms.lucaciotti.space/',
            'icon'        => 'fas fa-list',
            'topnav' => true,
            'target'        => '_blank',
            // 'can'  => ['config-read'],
        ],
        [
            'type'         => 'navbar-notification',
            'id'           => 'my-notification',
            'icon'         => 'fas fa-bell',
            'url'          => '#',
            'topnav_right' => true,
            // 'dropdown_mode'   => true,
            // 'dropdown_flabel' => 'All notifications',
            // 'update_cfg'   => [
            //     'url' => 'notifications/get',
            //     'period' => 30,
            // ],
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        // [
        //     'type'         => 'darkmode-widget',
        //     'topnav_right' => true, // Or "topnav => true" to place on the left.
        // ],
    ];
