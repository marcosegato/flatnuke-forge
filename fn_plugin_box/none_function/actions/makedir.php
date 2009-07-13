<?
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

$result = mkdir($to);

if ($result==false) die("Problema durante la creazione della cartella $to");
else echo "<p>Creo la cartella $to...</p>";
?>
