<?php
namespace Der\ChickenModel;

require_once("chicken.php");

class PouletDeBresse extends Chicken
{
    /**
     * PouletDeBresse constructor.
     *
     * Calls Chicken constructor with same parameters. Poulet de Bresse is the most highly prized
     * (and priced) type of chicken in France.
     * Assigns animal's normal call and its loud call.
     */
    function __construct($gender, $age, $location = 'the barn', $is_sleeping = false)
    {
        parent::__construct($gender, $age, $location, $is_sleeping);
        $this->voice =          'Cot cot codet!<br/>';
        $this->loud_voice =     'Cocorico!<br/>';
    }
}
