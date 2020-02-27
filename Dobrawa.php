<?php

require_once 'Phonetics.php';
require_once 'Morfologik.php';
require_once 'Rules.php';


class Dobrawa {
    
    static $LOG = array();
    
    function __construct() {
        $this->print = array(
            'jm' => 'ь',
            'jt' => 'ъ',
            'w' => 'v',
            'jat' => 'ě'
        );
    
        $this->Rules = new Rules("data/rules.rl");
        $this->Rules2 = new Rules("data/rules2.rl");
        
    }
    
    private function nice($wordarray) {
        $wa = array_slice($wordarray, 1, count($wordarray)-2);
        $return = "";
        foreach($wa as $letter)
            if (array_key_exists($letter, $this->print))
                    $return .= $this->print[$letter];
            else
                $return .= $letter;
        return $return;
        
    }    
    function translate($word) {
        $this->morf = new Morfologik($word);
        self::$LOG = array();
        $this->word = $word;
        $this->wordArray = Phonetics::graphem2phonem($word);
        $translated = $this->wordArray;
        #print_r($translated);
        
        $translated = $this->yers($translated);
        #print_r($translated);
        
        $translated = $this->ablaut($translated);
        $translated = $this->nasals($translated);
        #print_r($translated);
        $translated = $this->Rules->apply($translated, $word);
        $translated = $this->Rules2->apply($translated, $word);
        #print_r($translated);
        $translated = $this->endyers($translated);
        return $this->nice($translated);
    }
    function endyers($word) {
        $lastLetter = $this->wordArray[count($this->wordArray)-2];
        $lastLetter2 = $word[count($word)-2];
        if (Phonetics::isVowel($lastLetter2)):
            return $word;
        endif;
        $word2 = array_slice($word, 0, count($word)-1);
        if (Phonetics::isSoft( $lastLetter )) {
            #$word2 = array_slice($word, 0, count($word)-2);
            #$word2[] = Phonetics::$m2ps[$lastLetter];
            $word2[] = 'jm';
        }
        elseif (Morfologik::hasSoftEnding($this->word)) {
            $word2[] = 'jm';
        }
        else
            $word2[] = 'jt';
        
        $word2[] = '$';
        return $word2;
    }
    
    protected function yers($trans) {
        $yindex = 1+$this->morf->yer_index($this->word);
        if ($yindex == 0 || $yindex > count($trans)-3)
            return $trans;
        #echo $yindex;
        if (Phonetics::isVowel($trans[$yindex])) {
                self::$LOG[] = "$yindex: Wokalizacja jeru w pozycji mocnej";
                if ($trans[$yindex] == 'a' || $trans[$yindex] == 'o')
                    self::$LOG[] = "$yindex: Fałszywy przegłos";
                $trans[$yindex] =  $this->morf->yer_type($this->word, $yindex);  #'j'; #Phonetics::isSoft($trans[$yindex-1]) ? 'jm' : 'jt';
                return $trans;
        }
        else {
            self::$LOG[] = "$yindex: Zanik jeru w pozycji słabej";
            $result = array_slice($trans, 0, $yindex);
            $result[] = $this->morf->yer_type($this->word, $yindex);  # 'j'; #Phonetics::isSoft($trans[$yindex-1]) ? 'jm' : 'jt';
            $result = array_merge($result, array_slice($trans, $yindex)); 
            return $result;
        }
    }
    
    private function ablaut($trans) {
        for ($i=0; $i < count($trans)-1; $i++) {
            if (  ($trans[$i] == 'a' || ($trans[$i]) == 'o') &&
                  Phonetics::isSoft($trans[$i-1]) && 
                  in_array($trans[$i+1], array('t', 'd', 's', 'z', 'n', 'r', 'ł')) )
            {
                    self::$LOG[] = "$i: Przegłos ".($trans[$i] == 'a' ? 'lechicki' : 'polski');
                    $trans[$i] = $trans[$i] == 'a' ? 'jat' : 'e';
            }
            
        }
        return $trans;
    }
    
    private function nasals($trans) {
        for ($i=0; $i < count($trans)-1; $i++) {
            if (  $trans[$i] == 'ą' || ($trans[$i]) == 'ę'){
                $trans[$i] = Phonetics::isSoft($trans[$i-1]) ? 'ę' : 'ą';
            }
            
        }
        return $trans;
        
    }
    
}

?>
