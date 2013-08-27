<?php

require_once('AdjacencyList.php');


$alDir = new Graph_Data_Structures_AdjcanceyList();

$alDir->addEdge('a', 'b');
$alDir->addEdge('a', 'c');
$alDir->addEdge('c', 'd', 4);
$alDir->addEdge('d', 'c');

try { $alDir->updateEdgeWeight('a', 'b', 10); } catch (Exception $e) { echo "no such edge"; } echo "\n";
try { $alDir->updateEdgeWeight('a', 'd', 2); } catch (Exception $e) { echo "no such edge"; } echo "\n";

function echoHasEdge($a, $b, $graph) 
{
    echo ($graph->hasEdge($a, $b)) ? "Has $a->$b edge" : "No $a->$b edge";
    echo "\n";    
}

echo "\n\n=== has edge? ===\n";
echoHasEdge('a', 'b', $alDir);
echoHasEdge('b', 'a', $alDir);;
echoHasEdge('a', 'd', $alDir);
echoHasEdge('a', 'e', $alDir);
echoHasEdge('c', 'd', $alDir);
echoHasEdge('d', 'c', $alDir);

echo "\n\n=== edge weights ===\n";
try { echo $alDir->getEdgeWeight('a', 'b'); } catch (Exception $e) { echo "no such edge"; } echo "\n";
try { echo $alDir->getEdgeWeight('b', 'a'); } catch (Exception $e) { echo "no such edge"; } echo "\n";
try { echo $alDir->getEdgeWeight('a', 'd'); } catch (Exception $e) { echo "no such edge"; } echo "\n";
try { echo $alDir->getEdgeWeight('a', 'e'); } catch (Exception $e) { echo "no such edge"; } echo "\n";
try { echo $alDir->getEdgeWeight('c', 'd'); } catch (Exception $e) { echo "no such edge"; } echo "\n";
try { echo $alDir->getEdgeWeight('d', 'c'); } catch (Exception $e) { echo "no such edge"; } echo "\n";


echo "\n\n=== out edges ===\n";
print_r($alDir->outEdges('a'));
print_r($alDir->outEdges('b'));
print_r($alDir->outEdges('c'));
print_r($alDir->outEdges('e'));

echo "\n\n=== in edges ===\n";
print_r($alDir->inEdges('a'));
print_r($alDir->inEdges('b'));
print_r($alDir->inEdges('c'));
print_r($alDir->inEdges('e'));


// @TODO What happens if I try to add the same edge twice without removing it? What should happen?

// @TODO add tests for weighted graphs