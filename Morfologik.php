<?php

require_once 'Phonetics.php';

class Morfologik {
    
    
    public function __construct($word) {
        $this->load($word);
    }
    
    public function yer_type($word) {
        if (isset($this->yertype))
		return $this->yertype;
	else
		return -1;
    }
    
    public function yer_index($word) {
       	if (isset($this->yerindex))
		return $this->yerindex;
	else
		return -1;
    }
    
    private function load($word) {

       $fh = fopen("data/jery.txt", 'r');
       while ( $line = fgets($fh)) {
           if (mb_substr($line, 0, 1) < mb_substr($word, 0, 1))
		continue;
	if (mb_substr($line, 0, 1) > mb_substr($word, 0, 1))
		return;
           $vals = explode("|", trim($line));
           $index = $vals[2];
           $type = $vals[3];
           $forms = explode(',',$vals[0]); 
           foreach($forms as $form) {
                   if ($form == $word) {
				$this->yerindex = $index;
				$this->yertype = $type;
				return;
			}  			
           }    
       }
   }
   static public function hasSoftEnding($word) {
       $fh = fopen("data/softs.txt", 'r');
       while ( $line = fgets($fh)) {
           if (trim($line) == $word)
               return True;
       }
       return False;
   }
   public static function isVerb($word) {
       $fh = fopen("data/verbs.txt", 'r');
       while ( $line = fgets($fh)) {
           if (trim($line) == $word)
               return True;
       }
       return False;
   }
   public static function isAdj($word) {
       $fh = fopen("data/adjs.txt", 'r');
       while ( $line = fgets($fh)) {
           if (trim($line) == $word)
               return True;
       }
       return False;
   }
   public static function isLocSg($word) {
       $fh = fopen("data/locs.txt", 'r');
       while ( $line = fgets($fh)) {
           if (trim($line) == $word)
               return True;
       }
       return False;
   }
}

?>
