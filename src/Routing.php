<?php


namespace KingzCheung\RoutingMatch;


class Routing {

    private static ?Tree $tree = null;

    private function __construct() {
    }

    private function __clone(): void {
    }

    public static function create(array $routes): Tree {
        if (!self::$tree) {
            $tree = new Tree();
            foreach ($routes as $route) {
                $tree->addNode($route["method"], $route["url"]);
            }
            self::$tree = $tree;
            return $tree;
        }

        return self::$tree;
    }

    public function match(string $method, string $path): bool {
        $n = self::$tree->matchNode($method, $path);
        return $n != null;
    }

}