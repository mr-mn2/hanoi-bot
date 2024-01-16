<?php
namespace App\Controller;

use App\utilities\TowerOfHanoi;

class homeController extends mainController
{

    public function index()
    {
        $this->telegram->sendMessage($this->request->getUserID(), 'Welcome to Tower of Hanoi Bot! Send /hanoi to start.');
    }
    public function honoi()
    {
        $towerOfHanoi = new TowerOfHanoi((int)$this->request->getMessage());
        $steps = $towerOfHanoi->solve();

        $counter = 1;
        $str = '';
        $i = (int)$this->request->getMessage();
        while ($i >= 1){
            $str .= str_repeat('█',$i).' ';
            $i--;
            for ($e=$i; $e ==0 ; $e--) { 
                $str .= str_repeat('█',$e);
            }
        }
        $msg = 'main tower:
A: '.$str .' 
B: 
C: ';
        $result = $this->telegram->sendMessage($this->request->getUserID(), $msg);
        sleep(2);
        foreach ($steps as $index => $step) { 
            $this->telegram->editMessage($this->request->getUserID(), $result['result']['message_id'], "Step " . ($index + 1) . ":\n" . $step);
            $counter++;
            sleep(1);
        }

    }

}
