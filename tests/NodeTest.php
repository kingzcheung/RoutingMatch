<?php

namespace KingzCheung\RoutingMatch\Test;

use KingzCheung\RoutingMatch\Node;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase {

    public function testSearchNode() {
        $node = new Node();
        $node->addNode("foo/*/bar",["foo","*","bar"]);
        $n =$node->searchNode(["foo","*","bar"],1);
        $this->assertequals(null,$n);

    }

    public function testAddNode() {
        $node = new Node();
        $node->addNode("foo/bar",["foo","bar"]);

        $this->assertCount(1, $node->getChildren());
        $this->assertEquals("foo",$node->getChildren()[0]->getPart());
        $this->assertEquals("bar",$node->getChildren()[0]->getChildren()[0]->getPart());
    }
}
