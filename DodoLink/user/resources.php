<!DOCTYPE html>
<html>
<title>Resource</title>
<link rel="stylesheet" href="../css/mystyle.css">
<link rel="stylesheet" href="../css/menu.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="../css/table.css">

<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">
  <?php
      $activemenu="home";

      include('../includes/menu.php');

      require_once "../includes/db_connect.php";

  ?>


<div class="w3-content" style="max-width:1400px">

<!-- Header -->
<header class="w3-container w3-center w3-padding-32">
  <h1><b><span class="w3-tag">All</span>Resources</b></h1>
</header>


<div id='Resource'>
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names,Country.." title="Type in a name">

  <table id="myTable">
    <tr class="header">
      <th style="width:60%;">Name</th>
      <th style="width:40%;">Country</th>
    </tr>
    <tr>
      <td>Alfreds Futterkiste</td>
      <td>Germany</td>
    </tr>
    <tr>
      <td>Berglunds snabbkop</td>
      <td>Sweden</td>
    </tr>
    <tr>
      <td>Island Trading</td>
      <td>UK</td>
    </tr>
    <tr>
      <td>Koniglich Essen</td>
      <td>Germany</td>
    </tr>
    <tr>
      <td>Laughing Bacchus Winecellars</td>
      <td>Canada</td>
    </tr>
    <tr>
      <td>Magazzini Alimentari Riuniti</td>
      <td>Italy</td>
    </tr>
    <tr>
      <td>North/South</td>
      <td>UK</td>
    </tr>
    <tr>
      <td>Paris specialites</td>
      <td>France</td>
    </tr>
  </table>
</div>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    td1 = tr[i].getElementsByTagName("td")[1];

    if (td || td1) {
      txtValue = td.textContent || td.innerText;
      txtValue1= td1.textContent || td1.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>




</body>
</html>
