<?php

use LC\Routes;

Routes::map('gyms', function ($params) {
    Routes::load(view('gym/gyms'), $params, null, 200);
});

Routes::map('gyms/page/:num', function ($params) {
    Routes::load(view('gym/gym-items'), $params, null, 200);
});

Routes::map('gyms/search', function ($params) {
    Routes::load(view('gym/gym-items'), $params, null, 200);
});

Routes::map('gyms/search/page/:num', function ($params) {
    Routes::load(view('gym/gym-items'), $params, null, 200);
});

Routes::map('gym/single/:id', function ($params) {
    Routes::load(view('gym/single-gym'), $params, null, 200);
});
