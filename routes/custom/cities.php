<?php

use LC\Routes;

/*=============================
    [01. GET Routes]
===============================*/

Routes::map('get/cities/:id', function ($params) {
    Routes::load(view('get-cities'), $params, null, 200);
});

Routes::map('city/playground/:id', function ($params) {
    Routes::load(component('city-playground'), $params, null, 200);
});

Routes::map('city/playground/:id/page/:num', function ($params) {
    Routes::load(component('city-playground'), $params, null, 200);
});

Routes::map('city/coach', function ($params) {
    Routes::load(component('city-coach'), $params, null, 200);
});

Routes::map('city/coach/page/:num', function ($params) {
    Routes::load(component('city-coach'), $params, null, 200);
});