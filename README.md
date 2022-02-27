# Graph search

This program will help you determine if there is a path between two nodes that is less than the specified maximum latency. 

Graph nodes and the latency between each node is stored in the accompanying CSV file, please edit accordingly.  A demonstration node structure has already been defined in the file. 

Run program:

`php main.php`

Usage:

When prompted, enter a command in the following format

<START_NODE> <END_NODE> <MAX_LATENCY>

E.g.

`A F 1200`

This will search the data for a connection between A and F with a latency less than or equal to 1200ms

# Installation

Download composer and run `composer install`

# Testing

Run `./vendor/bin/phpunit tests`

# Assumptions

All node names are a single capital letter