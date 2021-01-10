const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

mix.sass("resources/assets/sass/coreui.scss", "public/css/app.css").styles(
    [
        "public/css/app.css",
        "resources/assets/css/custom.css",
        "node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css",
        "node_modules/animate.css/animate.min.css",
        "node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css",
        "node_modules/select2/dist/css/select2.min.css",
        "node_modules/daterangepicker/daterangepicker.css",
        "node_modules/quilljs/dist/quill.snow.css",
    ],
    "public/css/app.css"
);
mix.scripts(
    [
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/popper.js/dist/umd/popper.min.js",
        "node_modules/bootstrap/dist/js/bootstrap.min.js",
        "node_modules/pace-progress/pace.min.js",
        "node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js",
        "node_modules/@coreui/coreui/dist/js/coreui.min.js",
        "node_modules/sweetalert2/dist/sweetalert2.all.min.js",
        "node_modules/datatables.net/js/jquery.dataTables.min.js",
        "node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js",
        "node_modules/moment/min/moment.min.js",
        "node_modules/moment/min/moment-with-locales.min.js",
        "node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js",
        "node_modules/select2/dist/js/select2.min.js",
        "node_modules/chart.js/dist/Chart.min.js",
        "node_modules/fullcalendar/dist/locale/th.js",
        "node_modules/daterangepicker/daterangepicker.js",
        "resources/assets/js/custom.js"
    ],
    "public/js/app.js"
);
