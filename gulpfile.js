var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir(function(mix){
    mix.styles(['../../../node_modules/bootstrap/dist/css/bootstrap.css',
                './public/css/bootstrapPersonal.css',
                './public/css/neomorphic.css'
                ], 'public/css/styles.css');



    mix.browserify('main.js');

})
