<?php

use LC\Routes;

// GET Routes.

Routes::map('coachs', function ($params) {
    Routes::load(view('coachs'), $params, null, 200);
});

Routes::map('coachs/page/:num', function ($params) {
    Routes::load(view('coachs/coachs-item'), $params, null, 200);
});

Routes::map('coach/single/:id', function ($params) {
    Routes::load(view('single-coach'), $params, null, 200);
});
