<?php

require('vendor/autoload.php');

use Traverse\AdjacencyMatrix;

clear_screen();

$matrix = new AdjacencyMatrix();

//parse CSV data
try{

    if ( !file_exists($argv[1]) ) throw new Exception('File not found. Please check filename and try again.');

    if (($handle = fopen($argv[1], "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $matrix->add_weighted_edge($data[0], $data[1], $data[2]);
        }
        fclose($handle);
    }

}catch(Exception $e){
    echo $e->getMessage();
    exit;
}

//repeatedly prompt user for inptu
while(true){

    $input = trim(readline("Enter search path:"));
    $trimmed_input = trim($input);
    $capitalised_input = strtoupper($trimmed_input);

    if ($input == "QUIT"){
        exit;
    }elseif(preg_match('/([A-Z])\s([A-Z])\s(\d*)/', $input, $matches)){
        [,$latency, $path] = $matrix->find_fast_enough_path($matches[1], $matches[2], $matches[3]);
        if (!empty($path) && !empty($latency)){
            $path[] = array_sum($latency);
            echo implode(" => ",$path) . PHP_EOL;
        }else{
            echo "Path not found" . PHP_EOL;
        }
    }else{
        echo PHP_EOL;
        echo "Invalid entry.  Usage: <START_NODE> <END_NODE> <MAX_LATENCY>" . PHP_EOL;
        echo "All node names are a single captial letter" . PHP_EOL;
        echo PHP_EOL;
    }
}

//os independent clear screen
function clear_screen(){
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        system('cls');
    } else {
        system('clear');
    }
}