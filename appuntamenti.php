
<div id="lista">
<?php
if(isset($_GET['day']) && is_numeric($_GET['day']))
{
  $day = $_GET['day'];
  include 'config.php';
  $sql = "SELECT * FROM appuntamenti WHERE str_data=$day";
  $result = mysql_query($sql) or die (mysql_error());
  if(mysql_num_rows($result) > 0)
  {
    while($fetch = mysql_fetch_array($result))
    {
      $id = stripslashes($fetch['id']);
      $nome = stripslashes($fetch['Nome']);
      $data = date("d-m-Y", $fetch['str_data']); 
      echo "Disponibile il <b>$data</b><br>" . $nome . "<br>
      <a href=\"?p=cancella&id=$id\">Cancella</a> |
      <a href=\"?p=modifica&id=$id\">Modifica</a>
      <hr>";
    }
  } 
}
?>

<input class="bottone" id="bottone_lista" type="button" onclick="location.href = 'index.php?p=calendario'" value="Calendario">

</div>