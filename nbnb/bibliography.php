<html>
<head>
<script>
free1 = new Image();
free1.src = "/imgs/free1.jpg";
free2 = new Image();
free2.src = "/imgs/free2.jpg";
</script>
<title>voluntaryist.com</title>
<!-- red #C60000 -->
<link rel="stylesheet" href="/voluntaryist.css" type="text/css">
</head>
<body>
<div style="position: absolute; left: 0; top: 0; align: center">
<table align=center width=100% height=100%>
<tr width=100%>
<td valign="top"><a href="/soon.php">
<img src="/imgs/free1.jpg" onMouseOver="this.src = free2.src" onMouseOut="this.src = free1.src" border="0" alt="Free Your Mind" />
</a></td>
<td valign=top align=left>
<a href=/>
<img src="/imgs/logo1.jpg" alt="voluntaryist.com" border=0>
</a>
</td>
</tr>
<!-- second row -->
<tr>

<!-- Left hand Navigation -->
<td valign=top width=150>
    <?php include(getenv("DOCUMENT_ROOT")."/leftmenu.php"); ?>
</td>

<!-- Main Content -->
<td valign=top>
<center>
<table height="300" width=100% style="border-width: 1px; border-style: solid; border-color: #C60000; background-color: #FFFFFF">
<tr>
    <td height="100%" valign=top style="margin-left: 10px; margin-right: 10px">
    <div style="margin: 15px">
<h1>Bibliography</h1>
<center>
<!-- SiteSearch Google -->
<FORM method=GET action="http://www.google.com/search">
<input type=hidden name=ie value=UTF-8>
<input type=hidden name=oe value=UTF-8>
<TABLE bgcolor="#FFFFFF"><tr><td>
<A HREF="http://www.google.com/">
<IMG SRC="http://www.google.com/logos/Logo_40wht.gif"
border="0" ALT="Google"></A>
</td>
<td>
<INPUT TYPE=text name=q size=31 maxlength=255 value="">
<INPUT type=submit name=btnG VALUE="Google Search">
<font size=-1>
<input type=hidden name=domains value="www.Voluntaryist.com"><br><input type=radio name=sitesearch value=""> WWW <input type=radio name=sitesearch value="http://www.voluntaryist.com" checked> Voluntaryist.com <br>
</font>
</td></tr></TABLE>
</FORM>
<!-- SiteSearch Google -->
</center>
<br>

<li><a href="http://voluntaryist.com/bibliography/annotated.php" target="_blank">A Voluntaryist Bibliography, Annotated (1982)</a> by Carl Watner</li>
<li><a href="http://voluntaryist.com/bibliography/shortlist.php" target="_blank">A Voluntaryist Bibliography, The Short List</a> by Carl Watner (with suggestions from subscribers)</li>

    </div>
    </td>
</tr>
</table>
</center>
</td>
</tr>
<!-- end second row -->
</table>
</div>
</body>
</html>