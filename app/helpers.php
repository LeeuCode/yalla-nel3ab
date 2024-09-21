<?php

define('DS', DIRECTORY_SEPARATOR);

define('THEME_DIR_URI', get_template_directory_uri());

define('THEME_VERSION', 1.0);

define('SEARCH_PER_PAGES', 20);

function component($fileName)
{
    return get_template_directory() . '/resources/components/' . $fileName . '.php';
}

function view($fileName)
{
    return get_template_directory() . '/resources/view/' . $fileName . '.php';
}

function controller($fileName)
{
    return get_template_directory() . '/app/http/controller/' . $fileName . '.php';
}