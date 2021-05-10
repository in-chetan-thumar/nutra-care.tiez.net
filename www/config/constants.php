<?php

return [
    // 'ADMIN_ROLE_ID' => 1,
    'ROLES' => [
        'ADMIN' => 'ADMIN',
        'APP_USER' => 'APP_USER'
    ],

    'PRACTICE_MANAGER_EMAILS' => env('PRACTICE_MANAGER_EMAILS', 'demoemail512@gmail.com'),
	'APP_USER_ROLE_ID' => '2',

    // File storage
    'NOTIFICATION_PHOTO' => 'public' . DIRECTORY_SEPARATOR . 'notification' . DIRECTORY_SEPARATOR,
    'NOTIFICATION_PHOTO_URL' => 'storage' . DIRECTORY_SEPARATOR . 'notification' . DIRECTORY_SEPARATOR,

    'NEWS_PHOTO' => 'public' . DIRECTORY_SEPARATOR . 'news' . DIRECTORY_SEPARATOR,
    'NEWS_PHOTO_URL' => 'storage' . DIRECTORY_SEPARATOR . 'news' . DIRECTORY_SEPARATOR,

    'WALLPAPER_PHOTO' => 'public' . DIRECTORY_SEPARATOR . 'wallpaper' . DIRECTORY_SEPARATOR,
    'WALLPAPER_PHOTO_URL' => 'storage' . DIRECTORY_SEPARATOR . 'wallpaper' . DIRECTORY_SEPARATOR,

    'CATEGORY_THUMBNAIL' => 'public' . DIRECTORY_SEPARATOR . 'category_thumbnail' . DIRECTORY_SEPARATOR,
    'CATEGORY_THUMBNAIL_URL' => 'storage' . DIRECTORY_SEPARATOR . 'category_thumbnail' . DIRECTORY_SEPARATOR,

    'CATEGORY_PHOTO' => 'public' . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR,
    'CATEGORY_PHOTO_URL' => 'storage' . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR,

    'PRODUCT_PHOTO' => 'public' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR,
    'PRODUCT_PHOTO_URL' => 'storage' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR,
];

?>
