<?php

/*
 * Complete the 'evaluateGuess' function below.
 *
 * The function is expected to return an INTEGER_ARRAY, where:
 *  - the first  value is the number of red   pegs
 *  - the second value is the number of white pegs
 * The function accepts following parameters:
 *  1. STRING_ARRAY solution
 *  2. STRING_ARRAY guess
 */

function evaluateGuess($solution, $guess) {
    // $solution = ['purple', 'green', 'green', 'yellow']
    // $guess = ['blue', 'blue', 'blue', 'blue']
    if( $solution === $guess){
        return [count($solution), 0];
    }
    $red = 0;
    $white = 0;
    $i = 0;
    foreach( $guess as $elem ){
        if($elem === $solution[$i]){
            $red++;
            $solution[$i] = -1;
            $guess[$i] = -2;
        }
        $i++;
    }

    foreach( $guess as $elem ){
        $key = array_search($elem, $solution);
        if(is_numeric($key)){
            $white++;
            $solution[$key] = -1;
        }
    }
    return [$red, $white];
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$solution_count = intval(trim(fgets(STDIN)));

$solution = array();

for ($i = 0; $i < $solution_count; $i++) {
    $solution_item = rtrim(fgets(STDIN), "\r\n");
    $solution[] = $solution_item;
}

$guess_count = intval(trim(fgets(STDIN)));

$guess = array();

for ($i = 0; $i < $guess_count; $i++) {
    $guess_item = rtrim(fgets(STDIN), "\r\n");
    $guess[] = $guess_item;
}

$result = evaluateGuess($solution, $guess);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($fptr);
