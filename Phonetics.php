<?php

class Phonetics {
    
    static public $cons = array ('b', 'c', 'ć', 'd', 'dz', 'dź', 'dż', 'f', 'g', 'h', 'j', 'k', 'l', 'ł', 'm',
                                    'n', 'ń','p', 'r', 'rz', 's', 'ś', 'sz', 't', 'w', 'v', 'z', 'ż', 'ź');
    static public $m2ps = array(
        'ś' => 's',
        'ź' => 'z',
        'ż' => 'g',
        'sz' => 'x',
        'cz' => 'k',
        'ć' => 't',
        'dź' => 'd',
        'ń' => 'n',
        'rz' => 'r',
        'dź' => 'd',
        'dz' => 'g',
        'l' => 'l'
    );
    static public $digraphs = array('rz', 'sz', 'cz', 'dz', 'dź', 'dż', 'ch');
    static public $vowels = array('a', 'ą', 'e', 'ę', 'i', 'u', 'o', 'ó', 'jat', 'jm', 'jt');
    static public $m2m = array(
        'si' => 'ś',
        'zi' => 'ź',
        'ci' => 'ć',
        'ni' => 'ń',
        'dzi' => 'dź'
    );
    
    static public function isVowel($letter) {
        return in_array($letter, self::$vowels);
    }
    
    static public function beforeSoftYer($letter) {
        return strlen($letter)>1 && $letter[1]=='i' && !in_array($letter[0], array('k', 'g', 'x', 'h')) ||
                in_array($letter, array('cz', 'sz', 'ż', 'dź', 'ć', 'ś', 'ź', 'rz', 'ń', 'l'));
    }
    
    static public function isConsonant($letter) {
        return !in_array($letter, self::$vowels);
    }
    
    static public function isSoft($letter) {
        return array_key_exists($letter, self::$m2ps) || strlen($letter)>1 && $letter[1]=='i';
    }
    static public function norm($p) {
        if (array_key_exists($p, self::$m2m)) {
            return self::$m2m[$p];
        }
        elseif ($p[1] == 'i') {
            return $p[0];
        }
        else
            return $p;
    }
    
    static public function graphem2phonem($word) {
        $phonem = array('^');
        $word = mb_strtolower($word, "UTF-8");
        for ($i = 0; $i < mb_strlen($word, 'UTF-8'); $i++ ) {
            if ($i+2 < mb_strlen($word, 'UTF-8') && mb_substr($word, $i, 3, 'UTF-8') == 'dzi') {
                $phonem[] = self::$m2m[mb_substr($word, $i, 3, 'UTF-8')];
                if ($i+3 < mb_strlen($word, 'UTF-8') && in_array(mb_substr($word, $i+3, 1, 'UTF-8'), self::$vowels))
                    $i += 2;
                else 
                    $i += 1;
            }
            elseif ($i+1 < mb_strlen($word, 'UTF-8') && mb_substr($word, $i+1, 1, 'UTF-8') == 'i') {
                
                if (array_key_exists(mb_substr($word, $i, 2, 'UTF-8'), self::$m2m))
                    $phonem[] = self::$m2m[mb_substr($word, $i, 2, 'UTF-8')];
                else {
                    if (in_array(mb_substr($word, $i, 1, 'UTF-8'), array('k', 'g', 'h', 'ch', 'x')))
                            $phonem[] = mb_substr($word, $i, 1, 'UTF-8');
                    else
                        $phonem[] = mb_substr($word, $i, 2, 'UTF-8');
                }
                
                if ($i+2 < mb_strlen($word, 'UTF-8') && in_array(mb_substr($word, $i+2, 1, 'UTF-8'), self::$vowels))
                    $i++;
            }
            elseif ($i+1 < mb_strlen($word, 'UTF-8') && in_array(mb_substr($word, $i, 2, 'UTF-8'), self::$digraphs)) {
                $phonem[] = mb_substr($word, $i, 2, 'UTF-8');
                $i++;
            }
            
            else
                $phonem[] = mb_substr($word, $i, 1, 'UTF-8');
        }
    
        $phonem[] = '$';
        #print_r($phonem);
        return $phonem;
    }
   
}
?>
