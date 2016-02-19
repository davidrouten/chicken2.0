<?php
namespace Der\ChickenModel;

require_once("chicken.php");

class Life
{
    /**
     * Life constructor.
     *
     * @param integer   $weeks          The number of weeks the Life simulator will go over.
     * @param integer   $roosters       The number of roosters (non egg-layers) that you start with.
     * @param integer   $hens           The number of hens (egg-layers) that you start with.
     * @param integer   $foxes          The number of foxes that will try and eat all the chickens.
     */
    public function __construct($weeks, $roosters, $hens, $foxes)
    {
        $this->weeks = $weeks;
        $this->roosters = $this->loadRoosters($roosters);
        $this->hens = $this->loadHens($hens);
        $this->foxes = $foxes;
        $this->eggs = 0;
    }

    /**
     * This will take the number of weeks and simulate them one at a time.
     */
    public function run()
    {
        foreach (range(1, $this->weeks) as $week) {
            $this->runWeek($week);
        }
    }

    /**
     * Returns total number of chickens in the "coop"
     *
     * @return integer     Returns count of roosters + hens
     */
    public function getChickenCount()
    {
        return $this->getRoosterCount() + $this->getHenCount();
    }

    /**
     * Returns total number of roosters in the "coop"
     *
     * @return integer     Returns count of roosters
     */
    public function getRoosterCount()
    {
        return count($this->roosters);
    }

    /**
     * Returns total number of hens in the "coop"
     *
     * @return integer     Returns count of hens + hens
     */
    public function getHenCount()
    {
        return count($this->hens);
    }


    /**
     * Simulates a single week: how many chickens were eaten by foxes, how many eggs were
     * laid, and how many chicks (and genders) hatched from those eggs
     *
     * Displays a summary line of number of roosters, hens, and eggs that currently exist.
     */
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

    /**
     * This will cycle through all the roosters and hens, simulates their chance
     * to be "eaten" and removes them from the list if they are.
     */
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

    /**
     * This will check how many eggs were laid by all egg-laying hens in the "coop"
     */
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

    /**
     * This will check how many chicks were hatched from the eggs in the "coop"
     */
    private function checkChicksHatched($week)
    {
        $hatched = $this->eggs * 0.05;
        $new_hens = 0;
        $new_roosters = 0;

        foreach (range(0, (integer) $hatched) as $chick) {
            if (mt_rand(0, 1) === 0) {
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

    /**
     * This will create male Chicken models for each Rooster specified when the program was loaded.
     *
     * @return array        Returns array of roosters to be loaded into $this->roosters
     */
    private function loadRoosters($num)
    {
        $arr = array();
        foreach (range(1, $num) as $n) {
            $arr[] = new Chicken('male', 1);
        }
        return $arr;
    }

    /**
     * This will create female Chicken models for each Hen specified when the program was loaded.
     *
     * @return array        Returns array of hens to be loaded into $this->hens
     */
    private function loadHens($num)
    {
        $arr = array();
        foreach (range(1, $num) as $n) {
            $arr[] = new Chicken('female', 1);
        }
        return $arr;
    }
}
