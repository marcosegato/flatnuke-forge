<?
//include "sections/$mod/none_function/deepcopy.php";
$from=$action->source;
$from=$target_path.$from;
$to=$action->destination;
if ($info->type=="block") {
	$to="blocks/".$to;
}
if ($info->type=="section") {
	$to="sections/".$to;
}
if ($info->type=="theme") {
	$to="themes/".$to;
}
if ($info->type=="plugins") {
	$to=$to;
}
if ($info->type=="other") {
	$to=$to;
}

$result = copyr($from,$to);

if ($result==false) die("Problema durante la copia della cartella, da $from a $to");
else echo "<p>Copio la cartella $from in $to...</p>";
?>
