   FILE: SHOWIMG.ASP
   <%@ LANGUAGE="VBSCRIPT" %>
   <%
   ' Clear out the existing HTTP header information
   Response.Expires = 0
   Response.Buffer = TRUE
   Response.Clear

   ' Change the HTTP header to reflect that an image is being passed.
   Response.ContentType = "image/gif"

   Set cn = Server.CreateObject("ADODB.Connection")
   ' The following open line assumes you have set up a System DataSource
   ' by the name of myDSN.
   'Remember to change the following connection string parameters to reflect the correct values
   'for your SQL server.
   cn.Open "mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec'"
   Set rs = cn.Execute("SELECT avatar FROM user_data WHERE user_id='2'")
   Response.BinaryWrite rs("logo")
   Response.End
   %>