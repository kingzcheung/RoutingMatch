<?php

namespace KingzCheung\RoutingMatch;

use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase {

    public function testSearchNode() {
        $tre = new Tree();
        $tre->addNode("POST",'/roles/:id/users');
        $tre->addNode("GET",'/roles');
        $tre->addNode("GET",'/api/v1/permissions');

        $this->assertEquals(true,$tre->matchNode("POST","/roles/5/user") == null);
        $this->assertEquals(true,$tre->matchNode("POST","/roles/5/users") != null);
        $this->assertEquals(true,$tre->matchNode("GET","/roles/5/users") == null);
    }
}
