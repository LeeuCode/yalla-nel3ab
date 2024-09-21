<?php

use LC\Routes;

Routes::map('store', function ($params) {
    Routes::load(view('store/all'), $params, null, 200);
});

Routes::map('store/page/:num', function ($params) {
    Routes::load(view('store/product-items'), $params, null, 200);
});

Routes::map('products/:term_id', function ($params) {
    Routes::load(view('store/products'), $params, null, 200);
});

Routes::map('product/single/:id', function ($params) {
    Routes::load(view('store/single-product'), $params, null, 200);
});

Routes::map('my-orders', function ($params) {
    Routes::load(view('store/my-orders'), $params, null, 200);
});


Routes::map('checkout', function ($params) {
    Routes::load(controller('checkout'), $params, null, 200);
});
