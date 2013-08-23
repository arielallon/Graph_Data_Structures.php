<?php

require_once('AdjacencyList.php');


$alDir = new Graph_Data_Structures_AdjcanceyList();

$alDir->addEdge('a', 'b');
$alDir->addEdge('a', 'c');
$alDir->addEdge('c', 'd');
$alDir->addEdge('d', 'c');

function echoHasEdge($a, $b, $graph) 
{
    echo ($graph->hasEdge($a, $b)) ? "Has $a->$b edge" : "No $a->$b edge";
    echo "\n";    
}

echoHasEdge('a', 'b', $alDir);
echoHasEdge('b', 'a', $alDir);;
echoHasEdge('a', 'd', $alDir);
echoHasEdge('a', 'e', $alDir);
echoHasEdge('c', 'd', $alDir);
echoHasEdge('d', 'c', $alDir);

print_r($alDir->outEdges('a'));
print_r($alDir->outEdges('b'));
print_r($alDir->outEdges('c'));
print_r($alDir->outEdges('e'));

print_r($alDir->inEdges('a'));
print_r($alDir->inEdges('b'));
print_r($alDir->inEdges('c'));
print_r($alDir->inEdges('e'));