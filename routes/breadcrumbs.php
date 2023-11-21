<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for ('dashboard', function ($trail) {
    $trail->push(trans('validation.attributes.dashboard'), route('admin.dashboard.index'));
});

Breadcrumbs::for ('profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.profile'));
});

// Dashboard / Setting
Breadcrumbs::for ('setting', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.settings'));
});


// Dashboard / Employees
Breadcrumbs::for ('category', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.category'), route('admin.category.index'));
});

// Dashboard / category / Add
Breadcrumbs::for ('category/add', function ($trail) {
    $trail->parent('category');
    $trail->push(trans('validation.attributes.add'));
});

// Dashboard / category / Edit
Breadcrumbs::for ('category/edit', function ($trail) {
    $trail->parent('category');
    $trail->push(trans('validation.attributes.edit'));
});

// Dashboard / category / Show
Breadcrumbs::for ('category/show', function ($trail) {
    $trail->parent('category');
    $trail->push(trans('validation.attributes.view'));
});

Breadcrumbs::for('social-setting', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.social_settings'));
});

Breadcrumbs::for('editor-setting', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.editor_settings'));
});

Breadcrumbs::for ('post', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.post'), route('admin.post.index'));
});
// Dashboard / post / Add
Breadcrumbs::for ('post/add', function ($trail) {
    $trail->parent('post');
    $trail->push(trans('validation.attributes.add'));
});

// Dashboard / post / Edit
Breadcrumbs::for ('post/edit', function ($trail) {
    $trail->parent('post');
    $trail->push(trans('validation.attributes.edit'));
});

// Dashboard / post / Show
Breadcrumbs::for ('post/show', function ($trail) {
    $trail->parent('post');
    $trail->push(trans('validation.attributes.view'));
});
Breadcrumbs::for ('blog', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.blog'), route('admin.blog.index'));
});
// Dashboard / blog / Add
Breadcrumbs::for ('blog/add', function ($trail) {
    $trail->parent('blog');
    $trail->push(trans('validation.attributes.add'));
});

// Dashboard / blog / Edit
Breadcrumbs::for ('blog/edit', function ($trail) {
    $trail->parent('blog');
    $trail->push(trans('validation.attributes.edit'));
});

// Dashboard / blog / Show
Breadcrumbs::for ('blog/show', function ($trail) {
    $trail->parent('blog');
    $trail->push(trans('validation.attributes.view'));
});


// Dashboard / Role
Breadcrumbs::for ('roles', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.roles'), route('admin.role.index'));
});

// Dashboard / Role / Add
Breadcrumbs::for ('role/add', function ($trail) {
    $trail->parent('roles');
    $trail->push(trans('validation.attributes.add'));
});

// Dashboard / Role / Edit
Breadcrumbs::for ('role/edit', function ($trail) {
    $trail->parent('roles');
    $trail->push(trans('validation.attributes.edit'));
});

// Dashboard / Role / View
Breadcrumbs::for ('role/view', function ($trail) {
    $trail->parent('roles');
    $trail->push(trans('validation.attributes.view'));
});

// Setting Module
Breadcrumbs::for ('site-setting', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.site_settings'));
});
Breadcrumbs::for ('meta-setting', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.meta_settings'));
});

// Setting Module
Breadcrumbs::for ('email-setting', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.email_settings'));
});


// Setting Module
Breadcrumbs::for ('front-end-setting', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.front-end_settings'));
});

// Language Module
Breadcrumbs::for ('language', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.language'),route('admin.language.index'));
});

// Dashboard / Language / Add
Breadcrumbs::for ('language/add', function ($trail) {
    $trail->parent('language');
    $trail->push(trans('validation.attributes.add'));
});

// Dashboard / Language / Edit
Breadcrumbs::for ('language/edit', function ($trail) {
    $trail->parent('language');
    $trail->push(trans('validation.attributes.edit'));
});


Breadcrumbs::for ('breakingnews', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.breakingnews'), route('admin.breakingnews.index'));
});
// Dashboard / breakingnews / Add
Breadcrumbs::for ('breakingnews/add', function ($trail) {
    $trail->parent('breakingnews');
    $trail->push(trans('validation.attributes.add'));
});

// Dashboard / breakingnews / Edit
Breadcrumbs::for ('breakingnews/edit', function ($trail) {
    $trail->parent('breakingnews');
    $trail->push(trans('validation.attributes.edit'));
});

// Dashboard / breakingnews / Show
Breadcrumbs::for ('breakingnews/show', function ($trail) {
    $trail->parent('breakingnews');
    $trail->push(trans('validation.attributes.view'));
});


// Dashboard / Administrators
Breadcrumbs::for('administrators', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.administrators'), route('admin.adminusers.index'));
});

// Dashboard / Administrators / Edit
Breadcrumbs::for('administrators/add', function ($trail) {
    $trail->parent('administrators');
    $trail->push(trans('validation.attributes.add'));
});

// Dashboard / Administrators / Edit
Breadcrumbs::for('administrators/edit', function ($trail) {
    $trail->parent('administrators');
    $trail->push(trans('validation.attributes.edit'));
});

// Dashboard / Administrators / Edit
Breadcrumbs::for('administrators/view', function ($trail) {
    $trail->parent('administrators');
    $trail->push(trans('validation.attributes.view'));
});


// Dashboard / Employees
Breadcrumbs::for ('tag', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.tag'), route('admin.tag.index'));
});

// Dashboard / tag / Add
Breadcrumbs::for ('tag/add', function ($trail) {
    $trail->parent('tag');
    $trail->push(trans('validation.attributes.add'));
});

// Dashboard / tag / Edit
Breadcrumbs::for ('tag/edit', function ($trail) {
    $trail->parent('tag');
    $trail->push(trans('validation.attributes.edit'));
});