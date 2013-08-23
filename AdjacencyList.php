<?php

require_once('Interface.php');

class Graph_Data_Structures_AdjcanceyList implements Graph_Data_Structures_Interface
{
    public function __construct($directed=true) 
    {
        $this->_directed = $directed;
        $this->_init();
    }
    
    /**
     *  Initilize the class.
     */
    protected function _init()
    {
        $this->_graph = array();
    }
    
    /**
     *  Adds an edge between $a and $b to our graph.
     *  (From $a to $b, if this is a directed graph).
     *  Inherently adds vertices $a and $b, if not present.
     */
    public function addEdge($a, $b)
    {
        $this->_addEdge($a, $b, $this->_directed);
    }
    
    /**
     *  Internal function for adding an edge. 
     *  Takes care of adding both directions if graph is undirected.
     */
    protected function _addEdge($a, $b, $directed)
    {
        // Check if we have $a as a starting node. If not, initialize it.
        if (!isset($this->_graph[$a])) {
            $this->_graph[$a] = array();
        }
        // Check if $a-->$b has already been set. If not, set it.
        if (!isset($this->_graph[$a][$b])) {
            $this->_graph[$a][$b] = true;
        }
        
        // If this is an undirected graph, call this function with the vertices flipped.
        // But set directed as true for the call, so we don't recurse infinitely.
        if (!$directed) {
            $this->_addEdge($b, $a, true);
        }
    }
    
    /**
     *  Removes the edge between $a and $b from our graph.
     *  (From $a to $b, if this is a directed graph).
     */
    public function removeEdge($a, $b) 
    {
        $this->_removeEdge($a, $b, $this->_directed);
    }
    
    /**
     *  Internal function for removing an edge.
     *  Takes care of removing both directions if graph is undirected.
     */
    protected function _removeEdge($a, $b, $directed) 
    {
        // If edge is set, unset it.
        if (isset($this->_graph[$a][$b])) {
            unset($this->_graph[$a][$b]);
        }
        
        // If this is an undirected graph, call this function with the vertices flipped.
        // But set directed as true for the call, so we don't recurse infinitely.
        if (!$directed) {
            $this->_removeEdge($b, $a, true);
        }
    }
    
    /**
     *  Checks if we have an edge from $a to $b.
     *  (No need for a special undirected case.)
     */
    public function hasEdge($a, $b) 
    {
        return isset($this->_graph[$a][$b]);
    }
    
    /**
     *  Lists all vertices that have edges into $a
     */
    public function inEdges($a) 
    {
        // If this is an undirected graph, in edges are are the same as out edges.
        if (!$this->_directed) {
            return $this->outEdges($a);
        }
        
        $inEdges = array();
        foreach ($this->_graph as $vertex => $edges) {
            if (isset($edges[$a])) {
                $inEdges[$vertex] = true;
            }
        }
        return $inEdges;
    }
    
    
    /**
     *  Lists all vertices that have edges out of $a
     */
    public function outEdges($a) 
    {
        return (isset($this->_graph[$a])) ? $this->_graph[$a] : array();
    }

}