<? 
$xml = simplexml_load_file($target_path."install.xml");
if (!($xml instanceof SimpleXMLElement)) {
	fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
}
$n2 = $xml->xpath('//install_configuration/pre_inst');
$pre = $n2[0];
if (!($pre instanceof SimpleXMLElement)) {
	fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
}
$var=$pre->variable;
foreach ($var as $el_var) {
	if ($el_var->check_expr!="") {
		$vars=$el_var->name;
		echo _FNINST_CHECK . " " . $_POST[''.$vars] ." ". _FNINST_BY." ".$el_var->check_expr;
		if (!preg_match($el_var->check_expr, $_POST[''.$vars])) {
			$error[''.$vars]=true;
			echo " " ._FNINST_PARAMETERERR."<br>";
		}
		else echo " " ._FNINST_PARAMETEROK."<br>";
	}
}
?>
