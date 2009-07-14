<?
if (is_admin()) {
	$mod       = getparam("mod",       PAR_GET,  SAN_FLAT);
	$op        = getparam("op",        PAR_GET,  SAN_FLAT);
	$target_path = get_fn_dir("sections")."/$mod/none_uploads/";

	// language definition by configuration or by cookie
	$userlang = getparam("userlang", PAR_COOKIE, SAN_FLAT);
	if ($userlang!="" AND is_alphanumeric($userlang) AND file_exists(get_fn_dir("sections")."/$mod/none_lang/$userlang.php")) {
		$lang = $userlang;
	}
	switch($lang) {
		case "de" OR "es" OR "fr" OR "it" OR "pt":
			include_once (get_fn_dir("sections")."/$mod/none_lang/$lang.php");
		break;
		default:
			include_once (get_fn_dir("sections")."/$mod/none_lang/it.php");
	}
	?><h2><?=_FNINST_TITLE?></h2><?
	switch ($op) {
		case "check":
			//Controlla che siano rispettati i vincoli di installazione
			$error=Array();
			include get_fn_dir("sections")."/$mod/none_function/check.php";
			if (sizeof($error)==0) $op="inst";
			else $op="pre";
		break;
		case "":
			//pulizia della cartella uploads e visualizzazione form per l'upload dell'estensione
			include get_fn_dir("sections")."/$mod/none_function/clean.php";
			include get_fn_dir("sections")."/$mod/none_function/start.php";
		break;
		case "upload":
			//upload dell'estensione
			include get_fn_dir("sections")."/$mod/none_function/upload.php";
		break;
		case "pre":
			//operazioni preliminari all'installazione
			include get_fn_dir("sections")."/$mod/none_function/pre.php";
		break;
		case "inst":
			//[ToDo=spostare questo include]
			include get_fn_dir("sections")."/$mod/none_function/deepcopy.php";
			//operazioni per installare l'estensione
			include get_fn_dir("sections")."/$mod/none_function/inst.php";
		break;
		case "post":
			//operazioni post-installazione
			include get_fn_dir("sections")."/$mod/none_function/post.php";
		break;
		default:
			fn_die("PLUGINBOX","Op not valid[$op]",__FILE__,__LINE__);
	}
}
else fn_die("PLUGINBOX","Only Administrator allowed here!",__FILE__,__LINE__);
