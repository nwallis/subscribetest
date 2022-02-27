<?php declare(strict_types=1);

require('vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use Traverse\AdjacencyMatrix;

final class AdjacencyMatrixTest extends TestCase {

    public function test_add_edge():void{

        $test_latency = 666;
        $matrix = new AdjacencyMatrix();
        $matrix->add_weighted_edge('A','D',$test_latency);

        $first_direction_latency = $matrix->get_edge_weight('A','D');
        $second_direction_latency = $matrix->get_edge_weight('D','A');

        $this->assertEquals(
            $first_direction_latency,
            $test_latency
        );

        $this->assertEquals(
            $second_direction_latency,
            $test_latency
        );

    }

    public function test_edge_retrieval():void{
        $matrix = new AdjacencyMatrix();
        $matrix->add_weighted_edge('A', 'C', 100);
        $matrix->add_weighted_edge('A', 'F', 200);
        $matrix->add_weighted_edge('F', 'F', 10);
        $linked_nodes_a = $matrix->get_adjacent_nodes('A');
        $linked_nodes_f = $matrix->get_adjacent_nodes('F');
        $this->assertEqualsCanonicalizing($linked_nodes_a, ['C','F']);
        $this->assertEqualsCanonicalizing($linked_nodes_f, ['A','F']);
    }

    public function test_valid_path_search():void{
        $matrix = new AdjacencyMatrix();
        $matrix->add_weighted_edge('A', 'B', 10);
        $matrix->add_weighted_edge('A', 'C', 20);
        $matrix->add_weighted_edge('B', 'D', 100);
        $matrix->add_weighted_edge('C', 'D', 100);
        $matrix->add_weighted_edge('D', 'E', 10);
        $matrix->add_weighted_edge('E', 'F', 1000);
        [$path_found, $latency_accumulator, $visited_accumulator] = $matrix->find_acceptable_path('A','F',1200);
        $this->assertEquals($path_found, true);
    }

}