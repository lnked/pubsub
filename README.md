# pubsub

```shell
curl -s http://getcomposer.org/installer | php
php composer.phar require lnked/pubsub
```

Add an event onto the stack, you can add more than one event in one name:

```php
PS::subscribe('event-name', function ($message) {
    print_r($message);
});
```

Trigger event, by name:

```php
PS::publish('event-name');
PS::publish('event-name', 'event-parameter');
PS::publish('event-name', [1, 2, 3]);
```

### Methods

subscribe(<name>, <handler>)

publish(<name>)

unsubscribe(<name>)

subscription()

flush()
