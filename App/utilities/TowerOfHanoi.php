<?php
namespace App\utilities;

class TowerOfHanoi
{

    private $disks;
    private $towers;

    public function __construct($disks)
    {
        $this->disks = $disks;
        $this->towers = [
            'A' => array_reverse(range(1, $disks)),
            'B' => [],
            'C' => [],
        ];
    }

    public function solve()
    {
        $this->moveDisks($this->disks, 'A', 'C', 'B');
        return $this->towersState;
    }

    private function moveDisks($n, $source, $destination, $auxiliary)
    {
        if ($n > 0) {
            $this->moveDisks($n - 1, $source, $auxiliary, $destination);

            // Move disk
            $disk = array_pop($this->towers[$source]);
            array_push($this->towers[$destination], $disk);

            // Display current state
            $this->displayState();

            $this->moveDisks($n - 1, $auxiliary, $destination, $source);
        }
    }

    private function displayState()
    {
        $state = '';
        foreach ($this->towers as $tower => $disks) {
            $state .= $tower . ': ';
            foreach ($disks as $disk) {
                $state .= str_repeat('█', $disk) . ' ';
            }
            $state .= "\n";
        }
        $state .= "\n";
        $this->towersState[] = $state;
    }
}
