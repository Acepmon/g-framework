<?php

// Admin
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Admin > Changelog
Breadcrumbs::for('changelog', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Changelog', route('admin.changelog.index'));
});

// Admin > Configurations
Breadcrumbs::for('configs_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Configurations', route('admin.configs.index'));
});

// Admin > Configurations > Base Configurations
Breadcrumbs::for('configs_base', function ($trail) {
    $trail->parent('configs_index');
    $trail->push('Base Configurations', route('admin.configs.base'));
});

// Admin > Configurations > Maintenance
Breadcrumbs::for('configs_maintenance', function ($trail) {
    $trail->parent('configs_index');
    $trail->push('Maintenance', route('admin.configs.maintenance'));
});

// Admin > Themes
Breadcrumbs::for('themes_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Themes', route('admin.themes.index'));
});

// Admin > Themes > Installed
Breadcrumbs::for('themes_installed', function ($trail) {
    $trail->parent('themes_index');
    $trail->push('Installed Themes', route('admin.themes.installed'));
});

// Admin > Themes > Create
Breadcrumbs::for('themes_create', function ($trail) {
    $trail->parent('themes_index');
    $trail->push('Create', route('admin.themes.create'));
});

// Admin > Themes > Customize
Breadcrumbs::for('themes_customize', function ($trail) {
    $trail->parent('themes_index');
    $trail->push('Customize', route('admin.themes.customize'));
});
