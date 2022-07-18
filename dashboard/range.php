<?php
	require'conn.php';
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT * FROM `lista` WHERE `fecha` BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['id']?></td>
		<td><?php echo $fetch['nombres']?></td>
		<td><?php echo $fetch['dni']?></td>
		<td><?php echo $fetch['puesto']?></td>
        <td><?php echo $fetch['centrocostos']?></td>
		<td><?php echo $fetch['fecha']?></td>
		<td><?php echo $fetch['entrada']?></td>
		<td><?php echo $fetch['salida']?></td>
        <td></td>
	</tr>
<?php
			}
		}else{
			echo'
			<tr>
				<td colspan = "8"><center>Registros no Existen</center></td>
			</tr>';
		}
	}else{
		$query=mysqli_query($conn, "SELECT * FROM `lista`") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['id']?></td>
		<td><?php echo $fetch['nombres']?></td>
		<td><?php echo $fetch['dni']?></td>
		<td><?php echo $fetch['puesto']?></td>
        <td><?php echo $fetch['centrocostos']?></td>
		<td><?php echo $fetch['fecha']?></td>
		<td><?php echo $fetch['entrada']?></td>
		<td><?php echo $fetch['salida']?></td>
        <td></td>
	</tr>
<?php
		}
	}
?>
