<?php
return [
    "page"    =>  "trang/{slug}",
    "article"  =>  [
        "cat" => 'danh-muc-tin/{slug}',
        "detail" => '{slug}.html',
    ],
    "contact"    =>  'lien-he',
    "album"    =>  'hinh-anh',
    "video"    =>  'videos',
    "store"    =>  'he-thong-cua-hang',
    "product"    =>  [
        'home' => 'thuc-don',
        'cat' => 'thuc-don/{slug}',
        'detail' => 'san-pham/{slug}',
    ],
    'cart' => [
        'home' => 'cart',
        'delete' => 'xoa-san-pham/{id}',
        'success' => 'dat-hang-thanh-cong/{id}',
    ],
];
