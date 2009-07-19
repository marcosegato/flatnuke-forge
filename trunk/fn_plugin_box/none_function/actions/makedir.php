<?
$to=$action->destination;
switch ($tipo) {
	case "block";
		$to=get_fn_dir("blocks")."/".$to;
	break;
	case "section";
		$to=get_fn_dir("sections")."/".$to;
	break;
	case "theme";
		$to=get_fn_dir("themes")."/".$to;
	break;
	case "plugins";
	break;
	case "system_update";
	break;
	case "other";
	break;
	default:
}

$result = mkdir($to);

if ($result==false) fn_die("PLUGINBOX","Cannot create directory in $to",__FILE__,__LINE__);
else echo "<p>Creo la cartella $to...</p>";
?>
