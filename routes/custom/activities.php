<?php

use LC\Routes;

/*=============================
    [01. GET Routes]
===============================*/

Routes::map('activites', function ($params) {
    Routes::load(view('activity/activites'), $params, null, 200);
});

Routes::map('activity/single/:id', function ($params) {
    Routes::load(view('activity/single'), $params, null, 200);
});

Routes::map('activity/form/:term_id', function ($params) {
    Routes::load(component('activity-form'), $params, null, 200);
});

Routes::map('activity/category/:term_id', function ($params) {
    Routes::load(view('activity/activites-cat'), $params, null, 200);
});

/*=============================
    [02. POST Routes]
===============================*/

Routes::map('activity/store', function ($params) {
    Routes::load(controller('activity-store'), $params, null, 200);
});
