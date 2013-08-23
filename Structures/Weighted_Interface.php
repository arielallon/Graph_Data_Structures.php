<?php

interface Graph_Data_Structures_Weighted_Interface
    extends Graph_Data_Structures_Interface
{
    
    /**
     *  Adds an edge between $a and $b to our graph, with a $weight.
     *  (From $a to $b, if this is a directed graph).
     *  Inherently adds vertices $a and $b, if not present.
     */
    public function addEdge($a, $b, $weight);
    
    /**
     *  Removes the edge between $a and $b from our graph.
     *  (From $a to $b, if this is a directed graph).
     */
    public function removeEdge($a, $b);
    
    /**
     *  Checks if we have an edge between $a and $b.
     *  (From $a to $b, if this is a directed graph).
     */
    public function hasEdge($a, $b);
    
    /**
     *  Lists all vertices that have edges into $a
     */
    public function inEdges($a);
    
    
    /**
     *  Lists all vertices that have edges out of $a
     */
    public function outEdges($a);
    
    /**
     *  Returns the weight of the edge between $a and $b
     *  (From $a to $b, if this is a directed graph)
     */
    public function getEdgeWeight($a, $b);
    
    /**
     *  Updates the weight of the edge between $a and $b.
     *  (From $a to $b, if this is a directed graph)
     */
    public function updateEdgeWeight($a, $b, $weight);

}