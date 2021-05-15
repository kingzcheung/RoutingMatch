<?php

namespace KingzCheung\RoutingMatch;

use PHPUnit\Framework\TestCase;

class RoutingTest extends TestCase {

    public function testMatch() {
        $routes = [
            ["method"=>"POST","url"=>"/api/v2/resources"],
            ["method"=>"GET","url"=>"/api/v1/users/:id/roles"],
            ["method"=>"GET","url"=>"/api/v1/users/:id/comments"],
        ];
//        self::assertEquals(true,Routing::create($routes)->matchNode("POST","/api/v1/users") != null);
        self::assertEquals(true,Routing::create($routes)->matchNode("GET","/api/v1/users/12/roles") != null);
    }
}
