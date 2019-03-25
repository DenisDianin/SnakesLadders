<?php
    abstract class Game
    {
        protected $roll;
        protected $position;
        protected $newPosition;
		
        private function  __construct (int $position, int $roll, string $str)
        { 
            $this->position = $position;
            $this->roll = $roll;
            $this->str = $str; 
        }
        
        static function Play(int $position, int $roll)
        {
            if (($position + $roll) % 9 == 0):
                $game = new Snake ($position, $roll, 'Snake ');
            elseif (in_array($position + $roll, [25, 55])):
                $game = new Ladder ($position, $roll, 'Ladder ');
            else:
                switch ($position + $roll <=> 100):
                    case -1: $game = new Less100 ($position, $roll, ''); break;
                    case 0: $game = new Less100 ($position, $roll, 'Stop! '); break;
                    case 1: $game = new More100 ($position, $roll, 'Repeat Roll '); break;
                endswitch;
            endif;
            
            $game->Rules();
            $game->PrintStep();
            $game->NextStep();
        }
        
        abstract function Rules();
        
        private function PrintStep()
        {
            echo date('H:i:s').' | '.$this->roll.' - '.$this->str.$this->newPosition."\n";
        }
        
        private function NextStep()
        {
            sleep(1);
            $this->newPosition <> 100 ? Game::Play($this->newPosition, rand(1, 6)) : exit;
        }
    }
    
    class Snake extends Game
    {
        public function Rules()
        {
            $this->newPosition = $this->position + $this->roll - 3;
        }
    }
    
    class Ladder extends Game
    {
        public function Rules()
        {
            $this->newPosition = $this->position + $this->roll + 10;
        }
    }
    
    class Less100 extends Game
    {
        public function Rules()
        {
            $this->newPosition = $this->position + $this->roll;
        }
    }
    
    class More100 extends Game
    {
        public function Rules()
        {
            $this->newPosition = $this->position;
        }
    }
    
    Game::Play(1, rand(1, 6));
?>