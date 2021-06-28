<?php


namespace KingzCheung\RoutingMatch;


class Routing {

    public static function create(array $routes): Tree {
        $tree = new Tree();
        foreach ($routes as $route) {
            $tree->addNode($route["method"], $route["url"]);
        }
        return $tree;
    }
}