# Routing Match
---

```shell
composer require kingzcheung/routing-match

```

### Usage

```php
<?php

use KingzCheung\RoutingMatch\Routing;
$routes = [
            ["method"=>"POST","url"=>"/api/v2/resources"],
            ["method"=>"GET","url"=>"/api/v1/users/:id/roles"],
            ["method"=>"GET","url"=>"/api/v1/users/:id/comments"],
        ];
$n = Routing::create($routes)->matchNode("POST","/api/v1/users");

var_dump($n); // Node or null
```