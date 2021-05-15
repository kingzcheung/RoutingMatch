<?php

namespace KingzCheung\RoutingMatch;

class Node {
    private string $pattern = "";
    private string $part = "";
    /**
     * @var Node[]
     */
    private array $children = [];
    
    private bool $isWild = false;

    public function addNode(string $path, array $parts, int $index = 0) {
        if (count($parts) == $index) {
            $this->pattern = $path;
            return;
        }

        $part = $parts[$index];
        $child = null;

        foreach ($this->children as $c) {
            if ($c->getPart() == $part || $c->isWild()) {
                $child = $c;
            }
        }
        if ($child == null) {
            $child = new Node();
            $child->setPart($part);
            $child->setIsWild($this->checkWild($part));

            $this->addChild($child);
        }

        $child->addNode($part,$parts, $index + 1);
    }

    public function searchNode(array $parts, int $index = 0) :?Node {
        // 如何当前节点已经到了末尾或者当前节点存在*的情况，表示已经完结匹配
        if ($index==count($parts) || str_starts_with($this->part, "*")) {
            if ($this->pattern == "") {
                return null;
            }
            return $this;
        }
        $part = $parts[$index];
        foreach ($this->children as $child) {
            if ($child->part == $part || $child->isWild()) {
                $res = $child->searchNode($parts,$index + 1);
                if (null !== $res) {
                    return $res;
                }
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function getPart(): string {
        return $this->part;
    }

    /**
     * @param string $part
     */
    public function setPart(string $part): void {
        $this->part = $part;
    }

    /**
     * @return string
     */
    public function getPattern(): string {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     */
    public function setPattern(string $pattern): void {
        $this->pattern = $pattern;
    }

    /**
     * @return Node[]
     */
    public function getChildren(): array {
        return $this->children;
    }


    public function addChild(Node $child):void {
        array_push($this->children,$child);
    }

    /**
     * @return bool
     */
    public function isWild(): bool {
        return $this->isWild;
    }

    /**
     * @param bool $isWild
     */
    public function setIsWild(bool $isWild): void {
        $this->isWild = $isWild;
    }

    private function checkWild($part) :bool {
        if ($part[0]==="*" || $part[0] === ":") {
            return true;
        }

        if ($part[0] === "{" && $part[strlen($part) - 1] === "}") {

            return true;
        }

        return false;
    }
}