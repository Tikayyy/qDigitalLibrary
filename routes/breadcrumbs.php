<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Library
Breadcrumbs::for('library', function (BreadcrumbTrail $trail) {
    $trail->push('Library', route('books.library'));
});

// Library -> Favorite
Breadcrumbs::for('favorite', function (BreadcrumbTrail $trail) {
    $trail->parent('library');
    $trail->push('Favorite', route('books.library', ['favorite' => true]));
});

// Library -> Info
Breadcrumbs::for('info', function (BreadcrumbTrail $trail, $book_id) {
    $trail->parent('library');
    $trail->push('Info', route('books.info', ['book_id' => $book_id]));
});
