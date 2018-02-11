<?php
if (isset($_POST['submit']) && $_POST['submit']=="invia")
{
  $nome = addslashes($_POST['nome']);
  $str_data = strtotime($_POST['data']);
  include 'config.php';
  $sql = "INSERT INTO appuntamenti (nome,str_data ) VALUES ('$nome','$str_data')";
  if($result = mysql_query($sql) or die (mysql_error()))
  {
    echo "<div id='msg'>Inserimento avvenuto con successo.<br>
    Vai al <a href=\"index.php?p=calendario\">Calendario</a></div>";
  }
}else{
  ?>
<div id="form">
<form action="<?php echo $_SERVER['PHP_SELF']."?p=form"; ?>" method="post">
Nome:<br>
<input class="textbox" name="nome" type="text"><br>
Data:<br>
<input class="textbox"name="data" type="text" value="gg-mm-aaaa"><br>
<input id="bottone_form" class="bottone" name="submit" type="submit" value="invia">
</form>
</div>
  <?php
}
?>