<?php

use LC\Routes;

/*=============================
    [01. GET Routes]
===============================*/

Routes::map('intro', function ($params) {
    Routes::load('view/intro.php', $params, null, 200);
});

Routes::map('register', function ($params) {
    Routes::load(view('register'), $params, null, 200);
});

Routes::map('/login/', function ($params) {
    Routes::load(view('login'), $params, null, 200);
});

Routes::map('edit/user/:id', function ($params) {
    Routes::load(view('edit-user'), $params, null, 200);
});

Routes::map('championships/schedule/', function ($params) {
    Routes::load(view('championships/schedule'), $params, null, 200);
});

Routes::map('championships/schedule/table/:id', function ($params) {
    Routes::load(view('championships/table'), $params, null, 200);
});

Routes::map('home/', function ($params) {
    Routes::load(view('home'), $params, null, 200);
});

require dirname(__FILE__) . '/custom/playground.php';

require dirname(__FILE__) . '/custom/academy.php';

require dirname(__FILE__) . '/custom/coach.php';

require dirname(__FILE__) . '/custom/store.php';

require dirname(__FILE__) . '/custom/gym.php';

require dirname(__FILE__) . '/custom/activities.php';

require dirname(__FILE__) . '/custom/cities.php';

require dirname(__FILE__) . '/custom/user.php';

require dirname(__FILE__) . '/custom/championships.php';

Routes::map('gest/login', function ($params) {
    Routes::load(view('gest-login'), $params, null, 200);
});

Routes::map('payment/code/:code/msg/:msg', function ($params) {
    Routes::load(view('payment-status'), $params, null, 200);
});

Routes::map('chat', function ($params) {
    Routes::load(view('chat'), $params, null, 200);
});

Routes::map('chat/room', function ($params) {
    Routes::load(view('chat-room'), $params, null, 200);
});

Routes::map('notification/', function ($params) {
    Routes::load(view('notification'), $params, null, 200);
});

Routes::map('favorite', function ($params) {
    Routes::load(view('favorite'), $params, null, 200);
});

/*=============================
    [02. POST Routes]
===============================*/

Routes::map('update/user/:id', function ($params) {
    Routes::load(controller('update-user'), $params, null, 200);
});

Routes::map('register/request', function ($params) {
    Routes::load(controller('register-request'), $params, null, 200);
});

Routes::map('login/request', function ($params) {
    Routes::load(controller('login-request'), $params, null, 200);
});

Routes::map('login/request', function ($params) {
    Routes::load(controller('login-request'), $params, null, 200);
});

Routes::map('championship/store', function ($params) {
    Routes::load(controller('championship-store'), $params, null, 200);
});

Routes::map('booking/store', function ($params) {
    Routes::load(controller('booking-store'), $params, null, 200);
});

Routes::map('payment/status/:id', function ($params) {
    Routes::load(controller('payment-status'), $params, null, 200);
});

Routes::map('chat/save', function ($params) {
    Routes::load(controller('chat-save'), $params, null, 200);
});

Routes::map('search/category/', function ($params) {
    Routes::load(controller('search-category'), $params, null, 200);
});

Routes::map('action/:fun/:id', function ($params) {
    Routes::load(component($params['fun']), $params, null, 200);
});
