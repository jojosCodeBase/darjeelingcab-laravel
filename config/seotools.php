<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => false, // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'Explore the scenic beauty of Darjeeling with Darjeeling Cab – your trusted partner for comfortable and reliable taxi services. Discover top-notch transportation solutions for tourists and locals alike. Book your cab today for a memorable journey!', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => 'https://darjeelingcab.in/', // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => false, // set false to total remove
            'description' => 'Explore the scenic beauty of Darjeeling with Darjeeling Cab – your trusted partner for comfortable and reliable taxi services. Discover top-notch transportation solutions for tourists and locals alike. Book your cab today for a memorable journey!', // set false to total remove
            'url'         => 'https://darjeelingcab.in/', // Set null for using Url::current(), set false to total remove
            'type'        => 'Darjeeling Cab',
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => false, // set false to total remove
            'description' => 'Explore the scenic beauty of Darjeeling with Darjeeling Cab – your trusted partner for comfortable and reliable taxi services. Discover top-notch transportation solutions for tourists and locals alike. Book your cab today for a memorable journey!', // set false to total remove
            'url'         => 'https://darjeelingcab.in/', // Set null for using Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
