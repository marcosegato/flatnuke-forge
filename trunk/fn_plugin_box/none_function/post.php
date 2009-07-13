<?
$xml = simplexml_load_file($target_path."install.xml");
$n1 = $xml->xpath('//install_configuration/post_inst');
$post = $n1[0];
echo "<p>".$post->message."</p>";
echo "<p>"._FNINST_SUCCESS."</p>";
?>
