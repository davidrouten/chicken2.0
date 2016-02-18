<?php
namespace Der\ChickenModel;

require_once("chicken.php");

class Huhn extends Chicken
{
    /**
     * Huhn constructor.
     *
     * Calls Chicken constructor with same parameters. Huhn is German for 'chicken' (though it
     * may technically translate as hen).
     * Assigns animal's normal call and its loud call.
     */
    function __construct($gender, $age, $location = 'the barn', $is_sleeping = false)
    {
        parent::__construct($gender, $age, $location, $is_sleeping);
        $this->voice =          'Tock tock!<br/>';
        $this->loud_voice =     'Kikeriki!<br/>';
    }
}
