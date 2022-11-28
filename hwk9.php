<?php
//getting input search
$inputSearch = $_GET["searchKey"];

//print("You entered: ".$inputSearch);

//working with the uspresident database
//first thing we need to connect the database
//create a connection: setup the parameter
$server = "localhost";
$user = "root";
$password = "root";
$database = "uspresidentsdb";
$connection = mysqli_connect($server,$user,$password,$database) or die("No connection");

//print("connected");

//create a string variable that holds the SQL command to select records based on a filter

$SQLselect = "select * from uspresidentstable where match(name, birthstate,dob,dod,religion,party,term_of_office,inaug_age,death_age,firstlady,vp,picture) ".
"against('".$inputSearch . "'in natural language mode)";

//running the above command
$results = mysqli_query($connection,$SQLselect) or die("Query did not run,".mysqli_error($connection));
//print("Query ran");
//how many records 
$numrecs = mysqli_num_rows($results);

if($numrecs > 0){
    print("<table border='1'>
        <tr>
        <th>Name</th>
        <th>Party</th>
        <th>Picture</th>
        </tr>
    ");

    while($recordArray = mysqli_fetch_array($results)){
          $name = $recordArray[1];
          $party = $recordArray[6];
          $picture = $recordArray[12];
    }
    //send that table row to html
    print("<tr>
        <td>" .$name."</td><td>".$party."</td><td><img src= '".$picture."'/></td>".
    "</tr>");
    print("</table>");
} 
else{
    print("none");
}

?>