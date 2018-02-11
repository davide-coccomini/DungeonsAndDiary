<?php

function ShowCalendar($m,$y)
{
  if ((!isset($_GET['d']))||($_GET['d'] == ""))
  {
    $m = date('n');
    $y = date('Y');
  }else{
    $m = (int)strftime( "%m" ,(int)$_GET['d']);
    $y = (int)strftime( "%Y" ,(int)$_GET['d']);
    $m = $m;
    $y = $y;
  }
  $precedente = mktime(0, 0, 0, $m -1, 1, $y);
  $successivo = mktime(0, 0, 0, $m +1, 1, $y);
  $nomi_mesi = array(
    "Gen",
    "Feb",
    "Mar",
    "Apr",
    "Mag",
    "Giu", 
    "Lug",
    "Ago",
    "Set",
    "Ott",
    "Nov",
    "Dic"
  );
  $nomi_giorni = array(
    "Lun",
    "Mar",
    "Mer",
    "Gio",
    "Ven",
    "Sab",
    "Dom"
  );
  $cols = 7;
  $days = date("t",mktime(0, 0, 0, $m, 1, $y)); 
  $lunedi= date("w",mktime(0, 0, 0, $m, 1, $y));
  if($lunedi==0) $lunedi = 7;
  echo "<table>\n"; 
  echo "<tr>\n
  <td colspan=\"".$cols."\">
  <a href=\"?p=calendario&d=" . $precedente . "\"><<</a>
  " . $nomi_mesi[$m-1] . " " . $y . " 
  <a href=\"?p=calendario&d=" . $successivo . "\">>></a></td></tr>";
  foreach($nomi_giorni as $v)
  {
    echo "<td><b>".$v."</b></td>\n";
  }
  echo "</tr>";
  for($j = 1; $j<$days+$lunedi; $j++)
  {
    if($j%$cols+1==0)
    {
      echo "<tr>\n";
    }
    if($j<$lunedi)
    {
      echo "<td> </td>\n";
    }else{
      $day= $j-($lunedi-1);
      $data = strtotime(date($y."-".$m."-".$day));
      $oggi = strtotime(date("Y-m-d"));
      include 'config.php';
      $sql = "SELECT str_data FROM appuntamenti";
      $result = mysql_query($sql) or die (mysql_error());
	  $str_data = 0;
		
      if(mysql_num_rows($result) > 0)
      {
        while($fetch = mysql_fetch_array($result))
        {
          $str_data = $fetch['str_data'];
          if ($str_data == $data)
          {
            $day = "<a href=\"index.php?p=appuntamenti&day=$str_data\">$day</a>";
          }
        }
      }

	  $query="SELECT COUNT(*) as Numero FROM appuntamenti WHERE str_data=".$data."";
	  $sql = mysql_query("SELECT COUNT(*) as Numero FROM appuntamenti WHERE str_data=".$data."");
	  $count=mysql_fetch_assoc($sql);
	  $numero=$count["Numero"];
	  if($numero>=4){
		  if($data != $oggi)
		  {
			echo "<td class='blockdatagreen'><div class='top'>".$day.".</div><div class='bottom'>Disp:".$numero."</div></td>";
		  }else{
			echo "<td class='blockdatagreen'><div class='top'><b>".$day."</b></div><div class='bottom'>Disp:".$numero."</div></td>";
		  }
	  }else{
		  if($data != $oggi)
		  {
			echo "<td class='blockdata'><div class='top'>".$day.".</div><div class='bottom'>Disp:".$numero."</div></td>";
		  }else{
			echo "<td class='blockdata'><div class='top'><b>".$day."</b></div><div class='bottom'>Disp:".$numero."</div></td>";
		  }
	  }
    }
	
    if($j%$cols==0)
    {
      echo "</tr>";
    }
	
  }
  echo "<tr></tr>";
  echo "</table>";
}
ShowCalendar(date("m"),date("Y")); 

?>
<input type="button" onclick="location.href = '../index.php?p=form'" value="Inserisci" class="bottone">
