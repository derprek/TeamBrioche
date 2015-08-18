<!DOCTYPE html>
<html>
<head>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, td, th {
        border: 1px solid black;
        padding: 5px;
    }

    th {text-align: left;}
    </style>
</head>
<body>

    <?php
    $q = intval($_GET['q']);
/*
$con = mysqli_connect('localhost','root','cirras91','deco3801');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"deco3801");
$sql="SELECT * FROM products WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);*/

echo "<table>
<tr>
<th>Product Name</th>
<th>Manufactorer</th>
<th>Category</th>
<th>Price</th>
</tr>";

$newproduct = App\Product::find($q);

echo "<tr>";
echo "<td>" . $newproduct->name . "</td>";
echo "<td>" . $newproduct->manufactorer . "</td>";
echo "<td>" . $newproduct->category . "</td>";
echo "<td>" . $newproduct->price . "</td>";
echo "</tr>";

    /*while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['manufactorer'] . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "</tr>"; */
    }
    echo "</table>";
    mysqli_close($con);
    ?>
</body>
</html>