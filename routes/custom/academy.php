<?php

use LC\Routes;

// GET Routes.

Routes::map('academies/sections', function ($params) {
    Routes::load(view('academy/sections'), $params, null, 200);
});

Routes::map('academies/section/:term_id', function ($params) {
    Routes::load(view('academy/all'), $params, null, 200);
});

Routes::map('academies/section/:term_id/page/:num', function ($params) {
    Routes::load(view('academy/academy-items'), $params, null, 200);
});

Routes::map('booking/academy/:id', function ($params) {
    Routes::load(view('academy/single'), $params, null, 200);
});

// POST Routes.

Routes::map('academy/booking/store', function ($params) {
    Routes::load(controller('academy-booking-store'), $params, null, 200);
});
