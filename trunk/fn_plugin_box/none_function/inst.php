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
$n1 = $xml->xpath('//install_configuration/info');
$info = $n1[0];
$n3 = $xml->xpath('//install_configuration/inst');
$n3=$n3[0];
foreach($n3 as $action) {
	if (file_exists("sections/$mod/none_function/actions/". $action->type . ".php"))
		include "sections/$mod/none_function/actions/". $action->type . ".php";
}
echo "<p><a href=\"index.php?mod=$mod&op=post\">"._FNINST_FINISHINST."</p>";
?>
