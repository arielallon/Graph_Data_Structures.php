<?php

require_once '../Structures/Weighted_Interface.php';

class Graph_Algorithms_Dijkstra
{
    //@todo make sure weights are non-negative
    
    public static function findPath(Graph_Structures_Weighted_Interface $graph, $a, $b, $verbose=false)
    {
        $_graph = null;
        $_unvisited = array();
        $_visited = array();

        $_graph = $graph;
        // Init unvisited and mark all as distance infinity
        foreach ($_graph->getGraph() as $vertex => $edges) {
            $_unvisited[$vertex] = INF;
        }
        self::log("Our initial graph: \n".print_r($_graph->getGraph(), true), $verbose);

        // Ensure $a and $b are both actually in our graph
        if (!isset($_unvisited[$a]) || !isset($_unvisited[$b])) {
            throw new Exception('Both source and destination must be in graph');
        }

        // Set current node's distance to 0
        $_unvisited[$a] = 0;
        self::log("\nInit'd unvisited: \n".print_r($_unvisited, true), $verbose);

        // Set the initial values for the current node
        $currentNode = $a;
        $currentNodeDistance = 0;

        // Construct a list of immediate ancestors. This will function as "breadcrumbs" back home to reconstruct the shortest path
        $breadcrumbs = array($a => false);

        // Loop until the unvisited list is empty (though we may end early)
        while (!empty($_unvisited)) {
         
            // Loop through current node's out edges and assign distances if possible
            self::log("\nLooping through outEdges of $currentNode\n", $verbose);
            foreach ($_graph->outEdges($currentNode) as $vertex => $edgeWeight) {

                // Make sure we have no negative edges
                if ($edgeWeight < 0) {
                    throw new Exception("Negative edge weights are not allowed.");
                }

                // We only want to consider outEdges to unvisited vertices
                if (isset($_unvisited[$vertex])) {

                    // See if the distance through this edges beats the the shotest distance until now.
                    // if so, set this as the new distance
                    self::log("Distance of $vertex was ".$_unvisited[$vertex], $verbose);
                    $distance = $currentNodeDistance + $edgeWeight;
                    if ($_unvisited[$vertex] > $distance) {
                        $_unvisited[$vertex] = $distance;

                        // also, update our breadcrumbs
                        $breadcrumbs[$vertex] = $currentNode;
                    }
                    self::log(" and is now ".$_unvisited[$vertex]."\n", $verbose);
                }
                
            }

            // move the current node to the visited list
            self::moveNodeToVisitedList($currentNode, $_visited, $_unvisited);
            self::log("Moved $currentNode to visited list. Total unvisited: ".count($_unvisited)." | Total visited: ".count($_visited)."\n", $verbose);

            // If the current node was the destination, no need to continue looping
            if ($currentNode == $b) {
                break;
            }


            // loop through the unvisited nodes to select the next closest node. 
            // that will be our next currentNode
            $currentNodeDistance = reset($_unvisited);
            $currentNode = key($_unvisited);
            foreach ($_unvisited as $node => $nodeDistance) {
                if ($nodeDistance < $currentNodeDistance) {
                    $currentNodeDistance = $nodeDistance;
                    $currentNode = $node;
                }
            }
            self::log("Next node is $currentNode at a distance of $currentNodeDistance\n", $verbose);

            // If we looped through all the unvisited nodes and they're all and INF distance away,
            // then they are unconnected to our origin and we will never reach them. might as well bail.
            if ($currentNodeDistance === INF) {
                break;
            }

        }

        // Construct path. If there was no path, returned array will be empty.
        $path = array();
        if (isset($breadcrumbs[$b])) {

            // retrace our breadcrumbs, starting from the last node. push them onto a stack as we go
            $array[] = $b;
            $crumb = $b;
            while ($breadcrumbs[$crumb] !== false) {
                $crumb = $breadcrumbs[$crumb];
                $path[] = $crumb;
            }

            // now flip the stack (this should be less expensive than inserting at the front as we go would have been)
            $path = array_reverse($path);
        }
        return $path;
    }

    protected static function moveNodeToVisitedList($node, &$_visited, &$_unvisited)
    {
        $_visited[$node] = $_unvisited[$node];
        unset($_unvisited[$node]);
    }

    protected static function log($message, $verbose)
    {
        if ($verbose) {
            echo $message;
        }
    }
}