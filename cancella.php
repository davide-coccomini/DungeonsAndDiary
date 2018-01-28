<?php
include 'config.php';
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
  $del_id = $_GET['id'];
  $query = mysql_query("SELECT nome, str_data FROM appuntamenti WHERE id ='$del_id'");
  $fetch = mysql_fetch_array($query);
  $nome = $fetch['nome'];
  $data = date("d-m-Y", $fetch['str_data']); 
  ?>
<div id="form_cancella">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']."?p=cancella"; ?>">
<h1>Attenzione!</h1>
Si sta per eliminare la disponibilita' di
<b><?php echo stripslashes($nome); ?></b> 
del <?php echo stripslashes($data); ?>.<br>
Confermare per eseguire l'operazione.<br>
<br>
<input name="del_id" type="hidden" value="<?php echo $del_id; ?>">
<input class="bottone" id="bottone_cancella" name="submit" type="submit" value="Cancella">
</form>
</div>
  <?php
}
elseif(isset($_POST['del_id']) && is_numeric($_POST['del_id']))
{
  $del_id2 = $_POST['del_id'];
  if (mysql_query("DELETE FROM appuntamenti WHERE id = '$del_id2'")or die(mysql_error()))
  {
    echo "<div id='msg'>Cancellazione avvenuta con successo<br>
    <a href=\"index.php?p=calendario\">Torna al calendario</a></div>";
  }
}
?>