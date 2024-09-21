<?php

use LC\Routes;

// GET Routes.

Routes::map('reserve-playgrounds', function ($params) {
    Routes::load(view('playground/reserve-playgrounds'), $params, null, 200);
});

Routes::map('playgrounds/:id', function ($params) {
    Routes::load(view('playground/playground'), $params, null, 200);
});

Routes::map('playgrounds/:id/page/:num', function ($params) {
    Routes::load(view('playground/playground-items'), $params, null, 200);
});

Routes::map('playground/single/:id', function ($params) {
    Routes::load(view('playground/single-playground'), $params, null, 200);
});
