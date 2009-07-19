<?
$file_stream=file($target_path . "install.xml");
$fp=fopen($target_path . "install.xml",'w');
foreach ($file_stream as $linea) {
	foreach($_POST as $key=>$value)
		$linea = str_replace("@".$key."@",$value,$linea);
	fputs($fp,str_replace("@".$key."@",$value,$linea));
}
fclose($fp);
$xml = simplexml_load_file($target_path . "install.xml");
if (!($xml instanceof SimpleXMLElement)) {
	fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
}
$n1 = $xml->xpath('//install_configuration/info');
$info = $n1[0];
if (!($info instanceof SimpleXMLElement)) {
	fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
}
$n3 = $xml->xpath('//install_configuration/inst');
$n3=$n3[0];
if (!($n3 instanceof SimpleXMLElement)) {
	fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
}

//includo il gestore dell'azione $action->type che gestirà $action usando anche $info
foreach($n3 as $action) {
	if (file_exists("sections/$mod/none_function/actions/". $action->type . ".php"))
		include "sections/$mod/none_function/actions/". $action->type . ".php";
	else fn_die("PLUGINBOX",_FNINST_NOTVALID.": Could not handle action " . $action->type,__FILE__,__LINE__);
}
echo "<p><a href=\"index.php?mod=$mod&op=post\">"._FNINST_FINISHINST."</p>";
?>
