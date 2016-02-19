<?php
namespace Der\ChickenModel;

require_once("animal.php");

class Chicken extends Animal
{
    /**
     * Chicken constructor.
     *
     * Calls Animal constructor with same parameters.
     * Assigns animal's normal call and its loud call.
     */
    public function __construct($gender, $age, $location = 'the barn', $is_sleeping = false)
    {
        parent::__construct($gender, $age, $location, $is_sleeping);
        $this->voice =          'Cluck cluck!<br/>';
        $this->loud_voice =     'Cock-a-doodle-doo!<br/>';
    }

    /**
     * Chicken will lay an egg if it possibly can (gender must be 'female').
     *
     * @return string   Returns string describing the animal and the egg it laid, or a message
     *                  letting the user know why it couldn't lay an egg.
     */
    public function layEgg()
    {
        if (strtolower($this->gender) === 'female') {
            return $this->class . ' laid an egg!<br/>';
        } elseif(strtolower($this->gender) === 'male') {
            return "Males dont lay eggs...<br/>";
        } else {
            return 'Cannot determine gender of ' . $this->gender . '.<br/>';
        }
    }

    /**
     * Chicken will lay at least one egg if it possibly can (gender must be 'female').
     *
     * @param string    $num    The number of eggs this chicken is trying to lay, default is 1.
     * @return string   Returns string describing the animal and the egg(s) it laid, or a message
     *                  letting the user know why it couldn't lay the egg(s).
     */
    public function layEggs($num = 1)
    {
        if (strtolower($this->gender) === 'female') {
            if ($num === 1) {
                $this->layEgg();
            } else {
                return $this->class . " laid $num eggs!<br/>";
            }
        } elseif(strtolower($this->gender) === 'male') {
            return "Males don't lay eggs...<br/>";
        } else {
            return 'Cannot determine gender of ' . $this->gender . '.<br/>';
        }
    }
}
