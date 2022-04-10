const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .scripts('resources/js/rating.js', 'public/js/rating.min.js')
    .scripts('resources/js/vendors/create.js', 'public/js/vendors/create.min.js')
    .scripts('resources/js/vendors/edit.js', 'public/js/vendors/edit.min.js')
    //##################################### Purchase-request ##################################################

    .scripts(
        [
            "resources/js/settings/purchase-request/common.js",
            "resources/js/settings/purchase-request/attachments-upload.js",
            "resources/js/settings/purchase-request/create.js",
            "resources/js/settings/purchase-request/validation.js",
        ],
        "public/js/settings/purchase-request/create.min.js"
    )

    .scripts(
        [
            "resources/js/settings/purchase-request/common.js",
            "resources/js/settings/purchase-request/attachments-upload.js",
            "resources/js/settings/purchase-request/edit.js",
            "resources/js/settings/purchase-request/validation.js",
        ],
        "public/js/settings/purchase-request/edit.min.js"
    )
    //######################################## Purchase-request ############################################
    .styles(
        [
            "resources/css/settings/purchase-request/common.css",
            "resources/css/settings/purchase-request/attachments-upload.css",
        ],
        "public/css/settings/purchase-request/index.min.css"
    )

    .styles('resources/css/timeline.css','public/css/timeline.min.css')
    .styles('resources/css/rating.css','public/css/rating.min.css')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
