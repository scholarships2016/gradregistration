const {mix} = require('laravel-mix');

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

// mix.combine(['resources/assets/js/jquery/dist/jquery.min.js',
//     'node_modules/tether/dist/js/tether.min.js',
//     'node_modules/bootstrap/dist/js/bootstrap.min.js',
//     'resources/assets/js/PACE/pace.min.js',
//     'resources/assets/js/app.js'], 'public/js/app.js')
//     // .combine(['resources/assets/js/DataTables1_10_13/js/jquery.dataTables.min.js',
//     //     'resources/assets/js/DataTables1_10_13/js/dataTables.bootstrap4.min.js',
//     //     'resources/assets/js/DataTables1_10_13/js/dataTables.responsive.min.js',
//     //     'resources/assets/js/DataTables1_10_13/js/responsive.bootstrap4.min.js'], 'public/js/datatables.js')
//     .combine(['resources/assets/js/datatable/datatables.min.js','resources/assets/js/datatable/dataTables.bootstrap4.min.js'],'public/js/datatables.js')
//     .sass('resources/assets/sass/app.scss', 'public/css')
//     // .styles(['resources/assets/js/DataTables1_10_13/css/dataTables.bootstrap4.min.css',
//     //     'resources/assets/js/DataTables1_10_13/css/responsive.bootstrap4.min.css'], 'public/css/datatables.css')
//     .styles(['resources/assets/js/datatable/datatables.min.css','resources/assets/js/datatable/dataTables.bootstrap4.min.css'],'public/css/datatables.css')
//     .styles(['resources/assets/js/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css'], 'public/css/bootstrap-datepicker3.min.css')
//     .styles(['resources/assets/js/bootstrap-wizard/css/prettify.css'], 'public/css/prettify.css')
//     .styles(['resources/assets/js/select2/css/select2.min.css'], 'public/css/select2.min.css')
//     .copy('node_modules/toastr/build/toastr.min.js', 'public/js/toastr.js')
//     .copy('node_modules/toastr/build/toastr.min.css', 'public/css/toastr.css')
//     .copy('resources/assets/js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js', 'public/js/bootstrap-datepicker.min.js')
//     .copy('resources/assets/js/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.th.min.js', 'public/js/bootstrap-datepicker.th.min.js')
//     .copy('resources/assets/js/bootstrap-wizard/js/jquery.bootstrap.wizard.min.js', 'public/js/jquery.bootstrap.wizard.min.js')
//     .copy('resources/assets/js/bootstrap-wizard/js/prettify.js', 'public/js/prettify.js')
//     .copy('resources/assets/js/jquery.steps-1.1.0/jquery.steps.min.js', 'public/js/jquery.steps.js')
//     .copy('resources/assets/js/select2/js/select2.min.js', 'public/js/select2.min.js');


//AutoComplete
