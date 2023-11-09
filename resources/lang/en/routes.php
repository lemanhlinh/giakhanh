<?php
return [
    "page"    =>  "page/{slug}",
    "article"  =>  [
        "cat" => 'category-article/{slug}',
        "detail" => '{slug}.html',
    ],
    "contact"    =>  'contact',
    "album"    =>  'album',
    "video"    =>  'video',
    "store"    =>  'store',
    "product"    =>  [
        'home' => 'menu',
        'cat' => 'menu/{slug}',
        'detail' => 'product/{slug}',
    ],
    'cart' => [
        'home' => 'cart',
        'delete' => 'delete-product/{id}',
        'success' => 'order-success/{id}',
    ],
];
