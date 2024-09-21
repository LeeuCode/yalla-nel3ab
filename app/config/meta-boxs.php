<?php

//------ Inquiry Meta Boxs ------//
function lc_meta_box()
{
    add_meta_box(
        'lc_activity',
        __('تفاصيل الطلب', 'sitepoint'),
        'lc_activity_meta_box_callback',
        array(
            'activity',
            // 'champ',
            // 'foreign_marriage',
            // 'foreign_divorce',
        )
    );

    add_meta_box(
        'lc_booking_details',
        __('تفاصيل الحجز', 'qeema'),
        'lc_booking_details',
        array(
            'bookings',
        )
    );

    add_meta_box(
        'lc_order_details',
        __('تفاصيل الطلب', 'qeema'),
        'lc_order_details',
        array(
            'lc_order',
        )
    );
}

add_action('add_meta_boxes', 'lc_meta_box');

function lc_activity_meta_box_callback()
{
    include_once view('admin/activities-metabox');
}

function lc_fawry_details()
{
    include view('admin/fawry-metabox');
}

function lc_booking_details()
{
    include view('admin/booking-metabox');
}

function lc_order_details()
{
    include view('admin/order-metabox');
}
