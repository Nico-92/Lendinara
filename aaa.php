<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestione evento</title>
<link rel="stylesheet" type="text/css" href="stile.css" />
<script type="text/javascript" src="script.js"></script>
<script src="ajax/prototype.js" type="text/javascript"></script>
<script src="ajax/effects.js" type="text/javascript"></script>
<script src="ajax/controls.js" type="text/javascript"></script>
<style type="text/css">
    div.campo{
	font-family:Verdana;
        font-size:10px;
    }
    div.boxsuggerimenti {
      font-family:Verdana;
      font-size:10px;
      position:absolute;
      background-color:white;
      border:1px solid #888;
      margin:0px;
      padding:0px;
    }
    div.boxsuggerimenti ul {
      list-style-type:none;
      margin:0px;
      padding:0px;
    }
    div.boxsuggerimenti ul li.selected { background-color: #C2EBEF;}
    div.boxsuggerimenti ul li {
      list-style-type:none;
      display:block;
      margin:0;
      padding:1px;
      cursor:pointer;
      border-bottom:1px solid #888;
    }
</style>
</head>
<body>
<div align="center">
<div id="corpo">
<form name="squadra" method="post" action="salvasquadra.php">
<table>
<input type="text" hidden="hidden" name="evento" value=" <?php echo $_GET['evento'];?>" />
<tr><td>Nome</td><td><input name="nominativo" id="nominativo" type="text" /></td>
<div id="suggerimenti" class="boxsuggerimenti"></div>
<script type="text/javascript">new Ajax.Autocompleter("nominativo", "suggerimenti", "cerca.php", {minChars: 1});</script>
<td>Categoria</td><td><input type="text" name="categoria"  /></td></tr>
<tr><td>Moto</td><td><input type="text" name="moto" /></td>
<td>Numero</td><td><input type="text" size="3" name="numero" /></td>
</tr><tr><td>M.C.</td><td><input type="text" name="motorclub" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><input type="submit" /></td><td><input type="reset" /></td></tr>
</table>
</form>
</div></div>
</body>
</html>