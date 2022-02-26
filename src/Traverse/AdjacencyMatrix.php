<?php

namespace Traverse;

class AdjacencyMatrix{

    private $store;

    public function __construct(){
        $this->store = [];
    }

    public function add_weighted_edge($from, $to, $weight) {
        $this->store[$from][$to] = $weight;
        $this->store[$to][$from] = $weight;
    }

    public function get_edge_weight($from, $to) {
        return $this->store[$from][$to] ?? false;
    }

    public function get_connected_nodes($node) {
        return array_keys($this->store[$node]);
    }

}