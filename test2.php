<?php
    if(isset($_POST['search'])) {
        $response = "<ul><li>No data found</li></ul>";
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "foodbee";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        #echo "Connected successfully";
        

        $q = $conn->real_escape_string($_POST['q']);

        $sql = $conn->query("SELECT area FROM restaurant WHERE area LIKE '%$q%'");
        if($sql->num_rows != 0) {
            $response = "<ul>";
            while($data = $sql->fetch_array())
                $response .= "<li>".$data['area']."</li>";
            
            $response .= "</ul>";
        }


        exit($response);
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        ul {
            float: left;
            list-style: none;
            padding: 0px;
            border: 1px solid black;
            margin-top: 0px;
        }    
        input , ul {
            width:250px;
        }
    </style>
</head>
<body>
    <input type="text" placeholder="Search your area..." id="searchBox">
    <div id="response"><div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" 
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" 
    crossorigin="anonymous"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $("#searchBox").keyup(function(){
                var query = $("#searchBox").val();
                
                if(query.length > 0)
                {
                    $.ajax( 
                    {
                        url:'test2.php',
                        method:'POST',
                        data: {
                            search: 1,
                            q: query,
                        },
                        success: function(data) {
                            $("#response").html(data);
                        },
                        dataType: 'text'
                    }
                    );
                }

            })
        })

    </script>
</body>
</html>