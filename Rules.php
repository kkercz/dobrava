<?php

require_once 'Phonetics.php';
require_once 'Morfologik.php';

class Rule {
    
    function __construct($line) {
        #echo $line;
        $temp = explode(" > ", $line);
        $temp2 = explode('|', $temp[1]);
        if (count($temp2) == 2) {
            $this->comment = $temp2[1];
        }
            
            
        $this->praslav = explode(' ',$temp2[0]);
        
        $temp = explode('|', $temp[0]);
        if (count($temp) == 2):
            $this->condition = $temp[0];
            $temp = array($temp[1]);
        endif;
        $this->today = explode(' ', $temp[0]);
        $this->length = count($this->today);
    }
    
    function apply($word, $index, $genuine) {

	if ($index + $this->length > count($word)) {
		#echo $this->__toString().$index."<br />";                
		return False;
	}
        
        $map = array();
        for ($i=0; $i < $this->length; $i++) {
            $wordLetter = $word[$index+$i];
            $patternLetter = $this->today[$i];
            if ($wordLetter == $patternLetter) 
                continue;
            elseif (in_array($patternLetter,array('sp', 'sp#1', 'sp#2')) && Phonetics::isConsonant($wordLetter)) {
                $map[$patternLetter] = $wordLetter;
                #echo "<p> $patternLetter ---> $wordLetter </p>";
                continue;
            }
            else
                return False;            
        }
        $result = array();
        for ($i=0; $i < count($this->praslav); $i++) {
            $letter = $this->praslav[$i];
            if (in_array($letter,array('sp', 'sp#1', 'sp#2')))
                $result[] = $map[$letter];
            else
                $result[] = $letter;
        }
        if (isset($this->condition) && $this->condition == 'VERB' && !Morfologik::isVerb($genuine))
            return False;
        if (isset($this->condition) && $this->condition == 'ADJ' && !Morfologik::isAdj($genuine))
            return False;
	if (isset($this->condition) && $this->condition == 'LOCSG' && !Morfologik::isLocSg($genuine))
            return False;
        
	
        

        return $result;
    } 
    
    function __toString() {
        $today = implode(' ', $this->today);
        $praslov = implode(' ', $this->praslav);
        $cond = isset ($this->condition) ? "$this->condition|" : "";
	$comment = isset ($this->comment) ? "|$this->comment" : "";
        return "$cond$today > $praslov$comment";
    }
}

class Rules {
    
    function __construct($file) {
        $this->read($file);
    }

    function apply($word, $genuine) {
        $praslav = array();
        $applied = False;
        for ($i=0; $i < count($word); ) {
            
            foreach($this->Rules as $rule) {
		$applied = $rule->apply($word, $i, $genuine);
                if ($applied) {
                    if (isset ($rule->comment))
                        Dobrawa::$LOG[] = "$i: $rule->comment";
                    $i += $rule->length;
                    $praslav = array_merge($praslav, $applied);
                    
                    $ruleapplied = True;
                    break;
                }
            }
            
            if (!$applied) {
                $praslav[] = $word[$i];
                $i++;
            }
        }
        return $praslav;
    }
    
    protected function read($file) {
        $this->Rules = array();
        $fh = fopen($file, 'r');
        while ( $line = fgets($fh)){
            if ($line[0] == '#')
                continue;
            $rl = new Rule(trim($line));
            $this->Rules[] = $rl;
            #echo "<p>$rl</p>";
        }
        
    }
}

?>
