<?php
$userfile="../data/utilisateurs.txt"
function erplogin($id,$mdp,$file)
{
  $output = shell_exec('grep -oe "^.* '.$id.' '.$mdp.'$" '.$file.' | wc -l');
  if ($output == "1") {
	  return true;
  } else {
	  return false;
  }
}

#var_dump($argv);
if(erplogin($_POST[user_id],$_POST[user_mdp],$userfile)){
	echo "<script>location.href='../mutuelle.php?nuig=".$id."';</script>";
}else{
	echo "t'as ecris de la merde recommence";
};
?>