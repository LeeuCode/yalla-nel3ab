<?php

use LC\Routes;

// GET Routes.
Routes::map('coachs/categories', function ($params) {
    Routes::load(view('coachs/categories'), $params, null, 200);
});

Routes::map('coachs/:term_id', function ($params) {
    Routes::load(view('coachs/coachs'), $params, null, 200);
});

Routes::map('coachs/:term_id/page/:num', function ($params) {
    Routes::load(view('coachs/coachs-item'), $params, null, 200);
});

Routes::map('coachs/search/:term_id', function ($params) {
    Routes::load(view('coachs/coachs-item'), $params, null, 200);
});

Routes::map('coachs/search/:term_id/page/:num', function ($params) {
    Routes::load(view('coachs/coachs-item'), $params, null, 200);
});

Routes::map('coach/single/:id', function ($params) {
    Routes::load(view('coachs/single-coach'), $params, null, 200);
});
