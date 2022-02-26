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
        $linked_nodes_a = $matrix->get_connected_nodes('A');
        $linked_nodes_f = $matrix->get_connected_nodes('F');
      
        $this->assertEqualsCanonicalizing($linked_nodes_a, ['C','F']);
        $this->assertEqualsCanonicalizing($linked_nodes_f, ['A','F']);
    
    }

}