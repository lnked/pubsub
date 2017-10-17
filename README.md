# pubsub

```shell
curl -s http://getcomposer.org/installer | php
php composer.phar require lnked/pubsub
```

You can then load `.env` in your application with:

```php
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
```


### Methods

<?php

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
