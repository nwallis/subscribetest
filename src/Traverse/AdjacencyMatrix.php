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
        return $this->store[$from][$to] ?? 0;
    }

    public function get_adjacent_nodes($node) {
        return array_keys($this->store[$node]);
    }

    public function get_unvisited_nodes($node, $visited){
        return array_diff($this->get_adjacent_nodes($node), $visited);
    }

    public function find_fast_enough_path($from, $to, $max_latency, $visited = [], $latency = [], $path = []){

        $visited[] = $from;
        $path[] = $from;
        
        if (array_sum($latency) > $max_latency) return [$visited, [], []];

        if ($from === $to) {
            if (array_sum($latency) <= $max_latency){
                return [$visited, $latency, $path];
            }else{
                return [$visited, [], []];
            }
        }

        $unvisited_nodes = $this->get_unvisited_nodes($from, $visited);
        if (empty($unvisited_nodes)) return [$visited, [], []];

        foreach($unvisited_nodes as $adjacent_node){
            $latency[] = $this->get_edge_weight($from,$adjacent_node);
            [$visited_b, $latency_b, $path_b] = $this->find_fast_enough_path($adjacent_node, $to, $max_latency, $visited, $latency, $path);
            if (!empty($latency_b) && !empty($path_b)) return [$visited_b, $latency_b, $path_b];
            array_pop($latency);
        }

        return [$visited, [], []];

    }

}