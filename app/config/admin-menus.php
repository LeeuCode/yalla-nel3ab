<?php

//========= Admin Menu Optimizer ========//
function admin_menu_optimizer()
{
    //====> Posts
    remove_menu_page('edit.php');
    //====> Page
    // remove_menu_page('edit.php?post_type=page');
    //====> Dashboard
    // remove_menu_page( 'index.php' );
    //====> Media
    remove_menu_page('upload.php');
    //====> Comments
    remove_menu_page('edit-comments.php');
    //====> Appearance
    // remove_menu_page( 'themes.php' );
    //====> Plugins
    // remove_menu_page( 'plugins.php' );
    //====> Tools
    // remove_menu_page( 'tools.php' );
    //====> Advanced Custom Fields
    // remove_menu_page('edit.php?post_type=acf-field-group');
}