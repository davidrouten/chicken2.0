<?php
namespace Der\ChickenModel;

class Life
{
    public function __construct($weeks, $roosters, $hens, $foxes)
    {
        $this->weeks = $weeks;
        $this->roosters = $this->loadRoosters($roosters);
        $this->hens = $this->loadHens($hens);
        $this->foxes = $foxes;
        $this->eggs = 0;
    }

    public function run()
    {
        foreach (range(1, $this->weeks) as $week) {
            $this->runWeek($week);
        }
    }

    public function getChickenCount()
    {
        return $this->getRoosterCount() + $this->getHenCount();
    }

    public function getRoosterCount()
    {
        return count($this->roosters);
    }

    public function getHenCount()
    {
        return count($this->hens);
    }

    private function runWeek($week)
    {
        $r = count($this->roosters);
        $h = count($this->hens);
        $e = $this->eggs;

        echo "<strong>Week $week:</strong> $r roosters, $h hens, and $e eggs.<br/>";

        $this->checkFoxes($week);
        $this->checkEggsLaid($week);
        $this->checkChicksHatched($week);
    }

    private function checkFoxes($week)
    {
        $eaten_roosters = 0;
        $eaten_hens = 0;

        foreach ($this->roosters as $rooster) {
            if (mt_rand(0, 100 + $this->foxes) <= $this->foxes) {
                array_shift($this->roosters);
                $eaten_roosters += 1;
            }
        }

        foreach ($this->hens as $hen) {
            if (mt_rand(0, 100 + $this->foxes) <= $this->foxes) {
                array_shift($this->hens);
                $eaten_hens += 1;
            }
        }

        echo "Week $week: $eaten_roosters roosters and $eaten_hens hens were eaten by a fox!<br/>";
    }

    private function checkEggsLaid($week)
    {
        $total = 0;
        foreach ($this->hens as $hen) {
            $eggs = mt_rand(0, 2);
            $hen->layEggs($eggs);
            $this->eggs += $eggs;
            $total += $eggs;
        }

        echo "Week $week: $total eggs were laid.<br/>";
    }

    private function checkChicksHatched($week)
    {
        $hatched = $this->eggs * 0.05;
        $new_hens = 0;
        $new_roosters = 0;

        foreach (range(0, (integer) $hatched) as $chick) {
            if (mt_rand(0, 1) == 0) {
                $this->hens[] = new Chicken('female', 1);
                $new_hens += 1;
            } else {
                $this->roosters[] = new Chicken('male', 1);
                $new_roosters += 1;
            }
            $this->eggs -= 1;
        }

        echo "Week $week: $new_hens new hens and $new_roosters new roosters were hatched.<br/>";
    }

    private function loadRoosters($num)
    {
        $arr = array();
        foreach (range(1, $num) as $n) {
            $arr[] = new Chicken('male', 1);
        }
        return $arr;
    }

    private function loadHens($num)
    {
        $arr = array();
        foreach (range(1, $num) as $n) {
            $arr[] = new Chicken('female', 1);
        }
        return $arr;
    }
}