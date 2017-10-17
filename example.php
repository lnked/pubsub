<?php

// EXAMPLE
include __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'pubsub.php';

// Basic usage
PS::subscribe('beforeSave', function ($message) {
    echo 'PS::beforeSave', '<br>', print_r($message), '<br>', '<br>';
});

PS::subscribe('beforeSave', function ($message) {
    echo 'PS::beforeSave', '<br>', print_r($message), '<br>', '<br>';
});

PS::subscribe('beforeSave', function ($message) {
    echo 'PS::beforeSave', '<br>', print_r($message), '<br>', '<br>';
});

PS::subscribe('afterSave', function ($message) {
    echo 'PS::afterSave', '<br>', print_r($message), '<br>', '<br>';
});

// 
PS::publish('beforeSave', 'test-before');
PS::publish('afterSave', 'test-after');
PS::publish('afterSave');

// 
PS::unsubscribe('beforeSave');

// 
PS::flush();
