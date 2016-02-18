<?php
namespace Der\ChickenModel;

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/life.php");

$roosters = (integer) $_GET['roosters'];
$hens = (integer) $_GET['hens'];
$foxes = (integer) $_GET['foxes'];
$weeks = (integer) $_GET['weeks'];

?>
<form action =''>
    Roosters: <input type='number' name='roosters' placeholder='Number of roosters' value='25'/>
    Hens: <input type='number' name='hens' placeholder='Number of hens' value='25'/>
    Foxes: <input type='number' name='foxes' placeholder='Number of foxes' value='25'/>
    Weeks: <input type='number' name='weeks' placeholder='Number of weeks' value='52'/>
    <button type='submit'>Start Life!</button>
</form>
<?php
    if (isset($roosters) && isset($hens) && isset($foxes) && isset($weeks)) {
        $life = new Life($weeks, $roosters, $hens, $foxes);
        $life->run();
    }
?>
