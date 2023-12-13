<?php
$userfile="../data/utilisateurs.txt";

function erplogin($id,$mdp,$file)
{
  $output = shell_exec('grep -oe "^.* '.$id.' '.$mdp.'$" '.$file.' | wc -l');
  preg_match('/^1 */', $output, $matches);
  if ($matches) {
	  return true;
  } else {
	  return false;
  }
}

#var_dump($argv);
var_dump(erplogin($_POST["user_id"],$_POST["user_mdp"],$userfile));
if(erplogin($_POST["user_id"],$_POST["user_mdp"],$userfile)){
	echo "<script>location.href='/mutuelle.php?nuig=".$_POST["user_id"]."';</script>";
}else{
	echo "t'as ecris de la merde recommence";
};
?>
