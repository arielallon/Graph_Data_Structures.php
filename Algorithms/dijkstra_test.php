<?php

/**
 * Based on graph here: http://optlab-server.sce.carleton.ca/POAnimations2007/DijkstrasAlgo.html
 */

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

$path = Graph_Algorithms_Dijkstra::findPath($graph, 'o', 't', true);

echo "\n[a valid] shortest path is: \n";
print_r($path);


echo  "\n\n====================================================\n\n";
/**
 * Based on graph here: http://en.wikipedia.org/wiki/File:Dijkstra_Animation.gif
 */
$graph = new Graph_Structures_AdjacencyList(false);
$graph->addEdge('1', '2', 7);
$graph->addEdge('1', '6', 14);
$graph->addEdge('1', '3', 9);
$graph->addEdge('2', '3', 10);
$graph->addEdge('2', '4', 15);
$graph->addEdge('3', '4', 11);
$graph->addEdge('3', '6', 2);
$graph->addEdge('4', '5', 6);
$graph->addEdge('5', '6', 9);

$path = Graph_Algorithms_Dijkstra::findPath($graph, '1', '5', true);

echo "\n[a valid] shortest path is: \n";
print_r($path);

echo  "\n\n====================================================\n\n";
/**
 * Modification of above to remove path to destination
 */
$graph = new Graph_Structures_AdjacencyList(false);
$graph->addEdge('1', '2', 7);
$graph->addEdge('1', '6', 14);
$graph->addEdge('1', '3', 9);
$graph->addEdge('2', '3', 10);
$graph->addEdge('2', '4', 15);
$graph->addEdge('3', '4', 11);
$graph->addEdge('3', '6', 2);
//$graph->addEdge('4', '5', 6);
//$graph->addEdge('5', '6', 9);
$graph->addVertex('5');

$path = Graph_Algorithms_Dijkstra::findPath($graph, '1', '5', true);

echo "\n[a valid] shortest path is: \n";
print_r($path);

// @todo test with a directed graph