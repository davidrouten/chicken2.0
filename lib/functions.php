<?php
namespace Der\ChickenModel;

require_once($_SERVER['DOCUMENT_ROOT']."/models/poulet_de_bresse.php");

function live()
{
  $poulet = new PouletDeBresse('Male', 1);
  $poulet->shout();
}
