<?php

use LC\Routes;

/*=============================
    [01. GET Routes]
===============================*/

Routes::map('user/account', function ($params) {
    Routes::load(view('users/account'), $params, null, 200);
});

Routes::map('user/playgrounds', function ($params) {
    Routes::load(view('users/playgrounds'), $params, null, 200);
});

Routes::map('user/playground/edit/:id', function ($params) {
    Routes::load(view('users/playground-edit'), $params, null, 200);
});

Routes::map('user/academies', function ($params) {
    Routes::load(view('users/academies'), $params, null, 200);
});

Routes::map('user/academy/edit/:id', function ($params) {
    Routes::load(view('users/academy-edit'), $params, null, 200);
});

Routes::map('user/gyms', function ($params) {
    Routes::load(view('users/gyms'), $params, null, 200);
});

Routes::map('user/gym/edit/:id', function ($params) {
    Routes::load(view('users/gym-edit'), $params, null, 200);
});

/*=============================
    [02. POST Routes]
===============================*/

Routes::map('user/playground/update/:id', function ($params) {
    Routes::load(controller('playground-update'), $params, null, 200);
});

Routes::map('user/academy/update/:id', function ($params) {
    Routes::load(controller('academy-update'), $params, null, 200);
});
