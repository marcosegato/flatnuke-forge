<?
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
$result = copy($from,$to);

if ($result==false) die("Problema durante la copia di $from a $to");
else echo "<p>Copio $from in $to...</p>";
?>
