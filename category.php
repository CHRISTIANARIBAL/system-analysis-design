<?php
include('header.php');
checkUser();

include('user_header.php');

if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['category_id']) && $_GET['category_id'] >0) {

    $id = get_safe_value($_GET['category_id']);
    mysqli_query($con, "delete from category where category_id = $id");
}



$res = mysqli_query($con, "select * from category");
?>

<?php
if(mysqli_num_rows($res) > 0) {
?>

<h2>Category</h2>

<table>
    <tr>
        <td>ID</td>
        <td>Name</td>

    </tr>
    <?php while($row = mysqli_fetch_assoc($res)) { ?>
    <tr>
        <td><?php echo $row['category_id'];?></td>
        <td><?php echo $row['category_name'];?></td>
        <td>
            <a href="">Edit</a>
            <a href="?type=delete&category_id = <?php echo $row['category_id'];?>">Delete</a>&nbsp;
            
        </td>
    </tr>
    <?php } ?>
</table>

</br> <br>
<?php } else{
            echo "</br> No Data Found <br>";
        }
?>


<?php
include('footer.php');
?>