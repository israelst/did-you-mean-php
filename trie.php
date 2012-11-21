<?php 

// Based on:
// http://phpir.com/tries-and-wildcards/
// https://github.com/juanplopes/spellchecker-example

class Trie{
    private $trie;

    public function __construct() {
        $this->trie = array();
    }

    public function add($word){
        $node = &$this->trie;
        foreach(str_split($word) as $ch){
            if(!isset($node[$ch]))
                $node[$ch] = array();
            $node = &$node[$ch];
        }
        $node[0] = $word;
        //print_r($this->trie);
    }

    public function find($word, $dist=0){
        $result = array();
        $this->navigate($this->trie, $word, $results);
        return $result;
//        $node = &$this->trie;
//        foreach(array_keys($node) as $ch){
//            if($ch == 0){
//                $result[] = $node[$ch];
//
//            if(!isset($node[$ch]))
//                $node[$ch] = array();
//            $node = &$node[$ch];
//        }
//        $node[0] = $word;

    }

    public function navigate($node, $word, &$results, $so_far = '', $max_dist=0, $last=10){

        $node = $this->trie;
                print_r($node);
                print_r($node[$ch]);
        foreach(array_keys($node) as $ch){
            $so_far .= $ch;
            $distance = levenshtein($word, $so_far);
            print $ch;
            print $distance;
            if($distance <= $last){
            //if($distance <= $max_dist){
                if(isset($node[0]))
                    $results[] = $node[0];
            }
            $this->navigate($node[$ch], $word, $results, $so_far.$ch, $distance);
        }
        

       // $distance = levenshtein($word, $so_far);
       // if($distance <= $max_dist and isset($node[0])){
       //     $results[] = $node;
       //     $this->navigate($n, $word, $results, $so_far.$ch, $distance);
       // }
       // if($distance > $last){
       //     print $distance;
       //     $this->navigate($n, $word, $results, $so_far.$ch, $distance);
       // return $results;

//        if($distance <= $max_dist and isset($node[0]))
//
//        foreach(array_keys($node) as $n){
//            $this-<navigate($n, $word, $last, $results)
//        }
//
//        foreach(array_keys($this_trie) as $node){
//            $so_far .= $ch;
//            $distance = levenshtein($word, $so_far);
//            if($distance <= $max_dist and isset($node[0]))
//                $results[] = $node;
//
//            if($distance <= $last)
//                $this->navigate($word, $so_far, $distance);
//
//        }
//            
//        foreach(str_split($word) as $ch){
//            if(isset($node[$ch]))
//                $so_far .= $ch;
//                print "\n$so_far-" . levenshtein($word, $so_far);
//                if(levenshtein($word, $so_far) > $last)
//                    break;
//                else
//                    i
//                    $this->navigate($
//            $node = &$node[$ch];
//        }
//        
    }
}

$trie = new Trie();
$trie->add('casa');
$trie->add('case');
//$trie->add('camelo');
//$trie->add('cabeca');
//$trie->find('case');
print_r($trie->find('casa'));
