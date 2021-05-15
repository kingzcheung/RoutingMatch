<?php


namespace KingzCheung\RoutingMatch;


class Tree {
    /**
     * @var array[string][Node]
     */
    private array $root = [];

    /**
     * @param string $method
     * @param Node $node
     * @return void
     */
    public function addRoot(string $method,Node $node) {
        $this->root[$method] = $node;
    }

    public function addNode(string $method, string $path):void {
        $method = strtoupper($method);
        $parts = $this->parsePath($path);
        if (!array_key_exists($method,$this->root)) {
            $node = new Node();
            $node->setPart("/");
            $this->addRoot($method,$node);
        }
        $this->root[$method]->addNode($path,$parts,0);
    }

    public function matchNode(string $method, string $path) :?Node {
        $searchParts = $this->parsePath($path);

        if (!array_key_exists($method,$this->root)) {
            return null;
        }

        /** @var Node $node */
        $node = $this->root[$method];
        return $node->searchNode($searchParts,0);
    }

    private function parsePath(string $path):array {
        $path = trim($path);
        $path = ltrim($path,"/");
        $path = rtrim($path,"/");
        $ps = explode('/',$path);
        if (count($ps) == 0) return [];
        $parts = [];
        foreach ($ps as $p) {
            if ($p != "") {
                $parts[] = $p;
                if ($p[0]=="*") {
                    break;
                }
            }
        }

        return $parts;
    }

    /**
     * @return array
     */
    public function getRoot(): array {
        return $this->root;
    }
}