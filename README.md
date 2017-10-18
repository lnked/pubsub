# pubsub

```shell
curl -s http://getcomposer.org/installer | php
composer require lnked/pubsub
```

Add an event onto the stack, you can add more than one event in one name:

```php
PS::on('event-name', function ($message) {
    print_r($message);
});
```

Trigger event, by name:

```php
PS::trigger('event-name');
PS::trigger('event-name', 'event-parameter');
PS::trigger('event-name', [1, 2, 3]);
```

### Methods

# Attach an event handler function for one or more events
```php
PS::on('event-name', function($message) {
    echo $message;
});
```

# Remove an event handler
```php
PS::off('event-name');
```

# Execute all handlers and behaviors attached to the matched elements for the given event
```php
PS::trigger('event-name');
PS::trigger('event-name', 'test');
PS::trigger('event-name', [1, 2]);
PS::trigger('event-name', 1, 2, 3);
```

# List of events
```php
PS::list();
PS::list('event-name');
```

#Clears all existing events
```php
PS::flush();
```
