# Graph search

This program will help you determine if there is a path between two nodes that is less than the specified maximum latency. 

Graph nodes and the latency between each node is stored in the accompanying CSV file, please edit accordingly.  A demonstration node structure has already been defined in the file. 

Usage:

php graph_search.php <START_NODE> <END_NODE> <MAX_LATENCY>

E.g.

php graph_search.php A F 1000

# Installation

Download composer and run `composer install`

# Testing

Run `./vendor/bin/phpunit tests`

# Assumptions

All node names are a single captial letter