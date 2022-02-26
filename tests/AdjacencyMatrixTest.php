<?php declare(strict_types=1);

require('vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use Traverse\AdjacencyMatrix;

final class AdjacencyMatrixTest extends TestCase {

    public function testAddEdge():void{

        $test_latency = 666;
        $matrix = new AdjacencyMatrix();
        $matrix->add_weighted_edge('A','D',$test_latency);

        $first_direction_latency = $matrix->get_edge('A','D');
        $second_direction_latency = $matrix->get_edge('D','A');

        $this->assertEquals(
            $first_direction_latency,
            $test_latency
        );

        $this->assertEquals(
            $second_direction_latency,
            $test_latency
        );

    }

}