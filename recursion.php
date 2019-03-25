<?php
// recursive method
    class Game
    {
        private $roll;
        private $position;
        private $newPosition;
		
        public function Play(int $position, int $roll)
        {
            $this->position = $position;
            $this->roll = $roll;
            
            if (($this->position + $this->roll) % 9 == 0):
                
                $this->newPosition = $this->position + $this->roll - 3;
                echo date('H:i:s').' | '.$this->roll.' - Snake '.$this->newPosition."\n";
                
            elseif (in_array($this->position + $this->roll, [25, 55])):
                
                $this->newPosition = $this->position + $this->roll + 10;
                echo date('H:i:s').' | '.$roll.' - Ladder '.$this->newPosition."\n";
                
            elseif ($position + $roll <= 100):
                
                $this->newPosition = $this->position + $this->roll;
                echo date('H:i:s').' | '.$this->roll.' - '.$this->newPosition."\n";
                
            elseif ($this->position + $this->roll > 100):
                
                $this->newPosition = $this->position;
                echo date('H:i:s').' | '.$this->roll.' - Repeat Roll '.$this->newPosition."\n";
                
            endif;
            
            sleep(1);
            $this->newPosition <> 100 ? $this->Play($this->newPosition, rand(1, 6)) : exit;
        }
    }
    
    $game = New Game;
    $game->Play(1, rand(1, 6));
    
?>