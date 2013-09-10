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

echo "\n[a valid] shortest path from o to t is: \n";
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

echo "\n[a valid] shortest path from 1 to 5 is: \n";
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

echo "\n[a valid] shortest path from 1 to 5 is: \n";
print_r($path);

// @todo test with a directed graph


// Randomly created massive tests
function generateRandomGraph($numberOfVertices, $edgeLikelihood=50, $minWeight=0, $maxWeight=100, $directed=true) 
{
	$graph = new Graph_Structures_AdjacencyList($directed);
	
	for ($n=1; $n <= $numberOfVertices; $n++) {
		$graph->addVertex((string)$n);
	}

	for ($i=1; $i <= $numberOfVertices; $i++) {
		for ($j=1; $j <= $numberOfVertices; $j++) {
			if (mt_rand(1,100) <= $edgeLikelihood) {
				$graph->addEdge((string)$i, (string)$j, mt_rand($minWeight, $maxWeight));
			}
		}
	}

	return $graph;
}


echo "\n\n=========================================================\n\n";
echo "::Time trials::\n";
$numVerts = 2000;
$threshold = 10;
$directed = true;
echo "Time to create ";
echo ($directed) ? "a directed" : "an undirected"; 
echo " graph with $numVerts vertices and a $threshold% chance of an edge between any two vertices:\n";
$start = microtime(true);
$graph = generateRandomGraph($numVerts, $threshold, 0, 15, $directed);
$end = microtime(true);
echo $end - $start; echo "seconds\n";
$numPaths = 100;
echo "Times to find $numPaths arbitrary paths:\n";
echo "Start  End    Time    Path\n";
echo "-----------------------------------------------------\n";
for ($i=0; $i<$numPaths; $i++) {
	$orig = mt_rand(1, $numVerts);
	$dest = mt_rand(1, $numVerts);

	$start = microtime(true);
	$path = Graph_Algorithms_Dijkstra::findPath($graph, $orig, $dest);
	$end = microtime(true);
	
	echo str_pad($orig, 7) . str_pad($dest, 7);
	echo str_pad(round($end-$start, 4), 8);
	echo implode(':', $path);
	echo "\n";
}