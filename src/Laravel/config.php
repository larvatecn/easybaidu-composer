<?php

declare(strict_types=1);

/*
 * This file is part of the EasyBaiduComposer.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [

    'encryption' => [

        'key' => env('EASYBAIDU_KEY'),

    ],

    'delegation' => [

        'enabled' => env('EASYBAIDU_DELEGATION', false),

        'host' => env('EASYBAIDU_DELEGATION_HOST'),
    ],

];
