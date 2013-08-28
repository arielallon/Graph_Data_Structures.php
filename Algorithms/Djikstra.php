<?php

require_once '../Structures/Weighted_Interface.php';

class Graph_Algorithms_Djikstra
{
    //@todo make sure weights are non-negative
    
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
    }
}