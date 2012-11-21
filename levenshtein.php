<?php 

function distance($word1, $word2){
    if(strlen($word1) == 0)
        return strlen($word2);
    elseif(strlen($word2) == 0)
        return strlen($word1);
    else{
        $cost = $word1[0] == $word2[0]?0:1;
        return min(distance(substr($word1, 1), $word2) + 1,
                   distance($word1, substr($word2, 1)) + 1,
                   distance(substr($word1, 1), substr($word2, 1)) + $cost);
    }
}

function idistance($word1, $word2){
    $e = array(array());
    for($i = 0; $i <= strlen($word1); $i++)
        $e[$i][0] = $i;
    for($j = 1; $j <= strlen($word2); $j++)
        $e[0][$j] = $j;

    for($i = 1; $i <= strlen($word1); $i++)
        for($j = 1; $j <= strlen($word2); $j++){
            $cost = $word1[$i-1] == $word2[$j-1]?0:1;
            $e[$i][$j] = min($e[$i-1][$j] + 1,
                             $e[$i][$j-1] + 1,
                             $e[$i-1][$j-1] + $cost);
        }
    return end(end($e));
}

$function = 'distance';
$function = 'idistance';
//$function = 'levenshtein';

$tests = array(
      $function('a', 'a') == 0,
      $function('', 'a') == 1,
      $function('', 'abc') == 3,
      $function('a', '') == 1,
      $function('abc', '') == 3,
      $function('a', 'b') == 1,
      $function('aa', 'b') == 2,
      $function('casa', 'caso') == 1,
      $function('casarao', 'casa') == 3,
      $function('camarao', 'casa') == 4,
  );


foreach($tests as $test){
    print $test?'.':'F';
}






//die;

$word = $argv[1];
if(empty($word)){
    print "You have forgoten the word";
    die;
}

$lines = file("ptbr.txt");
print count($lines) . " loaded lines;\n";

print "Looking for $word\n";
$start = microtime(true);
foreach($lines as $line){
    if($function($word, $line) < 1)
        echo($line);
}
$end = microtime(true);
$duration = $end - $start;
print "\niDuration: $duration";

