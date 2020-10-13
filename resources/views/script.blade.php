
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<script type="text/javascript">
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function(){
     if (xmlhttp.readyState == 4 && xmlhttp.status==200) {
       // var response=JSON.parse(xmlhttp.responseText);
       // if (response.length>0) {
       //   alert(xmlhttp.responseText);
       // }
       // else {
       //
       // }
       alert(xmlhttp.responseText);
      }
    }
    xmlhttp.open('GET','/notification',true);
    xmlhttp.send();
</script>
  </body>
</html>
