<?php

require_once '../Structures/Weighted_Interface.php';

class Graph_Algorithms_Dijkstra
{
    //@todo make sure weights are non-negative
    
    /** @var Graph_Structures_Weighted_Interface $_graph **/
    protected $_graph = null;
    protected $_unvisited = array();
    protected $_visited = array();
    
    
    public function __construct(Graph_Structures_Weighted_Interface $graph)
    {
        $this->_graph = $graph->getGraph();
        
        // Init unvisited and mark all as distance infinity
        foreach ($this->_graph as $vertex => $edges) {
            $this->_unvisited[$vertex] = INF;
        }
    }
    
    public function findPath($a, $b)
    {

        // move the initial node to the visited set
        // Set current node's distance to 0
        $this->_unvisited[$a] = 0;

        $currentNode = $a;
        $currentNodeDistance = 0;
        while (!empty($this->_unvisited)) {


            foreach ($this->_graph->outEdges($current) as $vertex => $edgeWeight) {
                $distance = $currentNodeDistance + $edgeWeight;
                if ($this->_unvisited[$vertex] > $distance) {
                    $this->_unvisited[$vertex] = $distance;
                }
            }

            $this->moveNodeToVisitedList($current);
            if ($current == $b) {
                break;
            }

            $currentNodeDistance = reset($this->_unvisited);
            $currentNode = key($this->_unvisited);
            foreach ($this->_unvisited as $node => $nodeDistance) {
                if ($nodeDistance < $currentNodeDistance) {
                    $currentNodeDistance = $nodeDistance;
                    $currentNode = $node;
                }
            }

            if ($currentNodeDistance === INF) {
                break;
            }

        }

    }

    protected function moveNodeToVisitedList($node)
    {
        $this->_visited[$node] = $this->_unvisited[$node];
        unset($this->_unvisited[$node]);
    }
}