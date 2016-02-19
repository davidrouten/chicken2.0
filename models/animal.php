<?php
namespace Der\ChickenModel;

class Animal
{
    protected $gender;
    protected $age;
    protected $is_sleeping;
    protected $location;
    protected $voice;
    protected $loud_voice;
    protected $class;

    /**
     * Animal constructor.
     *
     * @param string  $gender         The gender of the animal, 'male' and 'female' are prefered inputs.
     * @param integer     $age            The age of the animal in years.
     * @param string  $location       The current location of the animal, non-proper nouns should be prefaced with 'the'.
     * @param boolean     $is_sleeping    Boolean if animal is sleeping or not, defaults to false.
     */
    public function __construct($gender, $age, $location = 'the barn', $is_sleeping = false)
    {
        $this->gender =         strtolower($gender);
        $this->age =            $age;
        $this->is_sleeping =    $is_sleeping;
        $this->location =       $location;
        $this->voice =          'Hello.<br/>';
        $this->loud_voice =     'Aiee!<br/>';
        $this->class =          get_class($this);
    }

    /**
     * Makes animal go to sleep unless it is already sleeping.
     *
     * @return string     Returns string describing action that occurred.
     */
    public function sleep()
    {
        if ($this->is_sleeping) {
            return $this->class . " is already asleep!<br/>";
        } else {
            $this->is_sleeping = true;
            return $this->class . " is now asleep.<br/>";
        }
    }

    /**
     * Makes animal wake up unless it is already awake.
     *
     * @return string     Returns string describing action that occurred.
     */
    public function wakeUp()
    {
        if ($this->is_sleeping) {
            $this->is_sleeping = false;
            return $this->class . ' is now awake.<br/>';
        } else {
            return $this->class . ' is already awake!<br/>';
        }
    }

    /**
     * Returns current location of animal.
     *
     * @return string     Returns string describing the animal and its location.
     */
    public function currentLocation()
    {
        return "$this->class is in $this->location.<br/>";
    }

    /**
     * Moves animal to a new location.
     *
     * @param string  $new_location   The animal's new location, non-proper nouns should be prefaced with 'the'.
     * @return string     Returns string describing the animal moving to its new location.
     */
    public function moveTo($new_location = null)
    {
        if ($new_location === null) {
            throw new Exception("Location can't be a null value.");
        }
        $this->location = $new_location;
        return "$this->class moved to $this->location.<br/>";
    }

    /**
     * Returns the text of the animal's normal call.
     *
     * @return string     Returns string representing the animal's normal call.
     */
    public function speak()
    {
        return $this->voice;
    }

    /**
     * Returns the text of the animal's loud call.
     *
     * @return string     Returns string representing the animal's loud call.
     */
    public function shout()
    {
        return $this->loud_voice;
    }

    /**
     * Returns the text representative of the current state of the animal.
     *
     * @return string     Returns string representing the animal including its gender, type,
     * and age in years.
     */
    public function toString()
    {
        return ucfirst($this->gender) . " $this->class - $this->age year(s) old<br/>";
    }

    /**
     * Getters
     */
    public function getGender()
    {
        return $this->gender;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getIsSleeping()
    {
        return $this->is_sleeping;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
