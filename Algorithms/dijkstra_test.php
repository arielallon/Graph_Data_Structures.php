<?php

require_once('Dijkstra.php');
require_once('../Structures/AdjacencyList.php');

$graph = new Graph_Structures_AdjacencyList(false);
$graph->addEdge('o', 'a', 2);
$graph->addEdge('o', 'b', 5);
$graph->addEdge('o', 'c', 4);
$graph->addEdge('a', 'b', 2);
$graph->addEdge('a', 'd', 7);
$graph->addEdge('a', 'f', 12);
$graph->addEdge('b', 'c', 1);
$graph->addEdge('b', 'd', 4);
$graph->addEdge('b', 'e', 3);
$graph->addEdge('c', 'e', 4);
$graph->addEdge('d', 'e', 1);
$graph->addEdge('d', 't', 5);
$graph->addEdge('e', 't', 7);
$graph->addEdge('f', 't', 3);

Graph_Algorithms_Dijkstra::findPath($graph, 'o', 't', true);