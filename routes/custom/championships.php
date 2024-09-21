<?php

use LC\Routes;

/*=============================
    [01. GET Routes]
===============================*/

Routes::map('championships', function ($params) {
    Routes::load(view('championships/all'), $params, null, 200);
});

Routes::map('champion/:id', function ($params) {
    Routes::load(view('championships/single'), $params, null, 200);
});

Routes::map('champion/category/:term_id', function ($params) {
    Routes::load(view('championships/champ-cat'), $params, null, 200);
});


// POST Routes.

Routes::map('champion/store/:id', function ($params) {
    Routes::load(controller('champion-store'), $params, null, 200);
});
