<?
if (is_admin()) {
	?>
	<h2>Tool per l'Installazione di componenti aggiuntivi su FlatNuke</h2>
	<?
	$mod       = getparam("mod",       PAR_GET,  SAN_FLAT);
	$op        = getparam("op",        PAR_GET,  SAN_FLAT);
	$target_path = "sections/$mod/none_uploads/";

	include "sections/$mod/none_lang/it.php";
	if ($op=="check") {
		//Controlla che siano rispettati i vincoli di installazione
		$error=Array();
		include "sections/$mod/none_function/check.php";
		if (sizeof($error)==0) $op="inst";
		else $op="pre";
	}
	if ($op=="") {
		//pulizia della cartella uploads e visualizzazione form per l'upload dell'estensione
		include "sections/$mod/none_function/clean.php";
		include "sections/$mod/none_function/start.php";
	}
	if ($op=="upload") {
		//upload dell'estensione
		include "sections/$mod/none_function/upload.php";
	}	

	if ($op=="pre") {
		//operazioni preliminari all'installazione
		include "sections/$mod/none_function/pre.php";
	}
	if ($op=="inst") {
		//operazioni per installare l'estensione
		include "sections/$mod/none_function/deepcopy.php";
		include "sections/$mod/none_function/inst.php";
	}
	if ($op=="post") {
		//operazioni post-installazione
		include "sections/$mod/none_function/post.php";
	}

}
else die(_NON_PUOI);
