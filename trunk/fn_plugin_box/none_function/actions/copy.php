<?
$from=$action->source;
$from=$target_path.$from;
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
$result = copy($from,$to);

if ($result==false) fn_die("PLUGINBOX","Cannot copy from $from to $to",__FILE__,__LINE__);
else echo "<p>Copio $from in $to...</p>";
?>
