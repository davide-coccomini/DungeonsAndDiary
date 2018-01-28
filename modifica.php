<?php
include 'config.php';
if(isset($_POST['mod_id'])&&(is_numeric($_POST['mod_id'])))
{
  $id = $_POST['mod_id'];
  $nome = addslashes($_POST['nome']);
  $str_data = strtotime($_POST['data']);
  $sql = "UPDATE appuntamenti SET Nome='$nome', str_data='$str_data' WHERE id = $id";
  if(mysql_query($sql) or die (mysql_error()))
  {
    echo "<div id='msg'>Modifica effettuata con successo.<br>
    Vai al <a href=\"index.php?p=calendario\">Calendario</a></div>";
  }
}
elseif (isset($_GET['id']) && is_numeric($_GET['id']))
{
  $id = $_GET['id'];
  $query = mysql_query("SELECT Nome,str_data FROM appuntamenti WHERE id = $id") or die (mysql_error());
  $fetch = mysql_fetch_array($query)or die (mysql_error());
  $nome = stripslashes($fetch['Nome']);
  $data = date("d-m-Y", $fetch['str_data']); 
  ?>
<div id="form_modifica">
<form action="<?php echo $_SERVER['PHP_SELF']."?p=modifica"; ?>" method="post">Nome:<br>
<input name="nome" type="text" value="<?php echo $nome; ?>">

</textarea>
<br>Data:<br>
<input name="data" type="text" value="<?php echo $data; ?>">
<br><input name="mod_id" type="hidden" value="<?php echo $id; ?>">
<input class="bottone" id="bottone_modifica"name="submit" type="submit" value="modifica">
</form>
</div>
  <?php
}
?>