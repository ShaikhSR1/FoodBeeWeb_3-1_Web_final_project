<html>
<head>
 <link rel="stylesheet" type="text/css" href="searchstyle.css" />
 <script type="text/javascript" src="jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="jquery.autocomplete.js"></script>
 <script> 
 jQuery(function(){ 
 $("#search").autocomplete("search.php");
 });
 </script>
</head>
<body>
 <form action="search.php">
 Book Name : <input type="text" name="q" id="search" placeholder="Enter Book Name">
 <input class="btn" type="submit" value="Submit"/>
 </form> 
</body>
</html>