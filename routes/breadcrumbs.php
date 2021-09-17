<?php

Breadcrumbs::for('admin-dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin-dashboard'));
});

Breadcrumbs::for('admin-manage-ui', function ($trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Manage UI', route('admin-manage-ui'));
});

Breadcrumbs::for('admin-manage-home-carousel-sliders', function ($trail) {
    $trail->parent('admin-manage-ui');
    $trail->push('Carousel Sliders', route('admin-manage-home-carousel-sliders'));
});

Breadcrumbs::for('admin-edit-home-carousel-slider', function ($trail, $slider_id) {
    $trail->parent('admin-manage-home-carousel-sliders');
    $trail->push('Edit', route('admin-edit-home-carousel-slider', $slider_id));
});

