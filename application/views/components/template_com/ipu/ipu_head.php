<?php
function index($value)
{


    $_this = &get_instance();
    $obj = (object) json_decode($value);
    echo '
    
<br><br><br>
<form>
<input type=hidden name="txtJab" readOnly value="">
<input type=hidden name="txtKem" readOnly value="">
<body> <!--- onLoad="window.print()" --->            
<center>                                                                               
  <table border="0" cellpadding="0" cellspacing="0" width="1007" height="16" background="../e-Matrik/Icon/kotakSki.jpg" style="border-collapse: collapse" bordercolor="#111111">
    <tr>
      <td height="16" width="955" align="left" valign="top"><b>
    <font face="Arial" size="2">SULIT     </font></b></td>

    </tr>
    <tr>
      <td><center><img src="'.base_url().'img/jata.gif" style="width: 140px"></center></td>
    </tr>
    <tr>
      <td height="16" width="955" align="center" valign="top"> <center><h1>Profil Indikator Perwatakan Unggul <br>Jabatan Perkhidmatan Awam</h1> </td>
  
    </tr>
    </table>
  <br><br>

  <table border="0" width="951">
<tr> 
  <td align="left"> <b><font face="Arial Narrow"> Nama </font> </b></td>
  <td>: </td>
  <td width="800"> <b><font face="Arial Narrow"> '.$_this->Responden->getNamaByNoKP($obj->nokp).' </b></font></td>
</tr>
<tr>
  <td> <b><font face="Arial Narrow"> No. KP </font></b> </td>
  <td>: </td>
  <td> <b><font face="Arial Narrow">'.$obj->nokp.'</b> </font></td>
</tr>
<tr>
    <td> <b><font face="Arial Narrow"> Tempat Bertugas </font> </b></td>
    <td>:</td>
    <td> <b><font face="Arial Narrow"> '.$obj->agensi.' </font> </b></td>
</tr>
</table>
<br><br>';
}
