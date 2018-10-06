<?php 
	$conn = mysqli_connect('localhost','root','','db_belajar');
	$provinces = mysqli_query($conn, "SELECT id,name FROM provinces");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Province & City</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		
		function getRegencies(elem){
			$.ajax({
			  dataType: "json",
			  url: "data.php",
			  data: "type=regencies&id="+elem.value,
			  success: function(results) {
			  	var target = $("#regency");
			  	target.html("<option>-- Choose --</option>");
			  	$.each(results, function(i, result){
		           	target.append("<option value='"+result.id+"'>"+result.name+"</option>");
		        });
			  }
			});
		}

		function getDistricts(elem){
			$.ajax({
			  dataType: "json",
			  url: "data.php",
			  data: "type=districts&id="+elem.value,
			  success: function(results) {
			  	var target = $("#district");
			  	target.html("<option>-- Choose --</option>");
			  	$.each(results, function(i, result){
		           	target.append("<option value='"+result.id+"'>"+result.name+"</option>");
		        });
			  }
			});
		}

		function getVillages(elem){
			$.ajax({
			  dataType: "json",
			  url: "data.php",
			  data: "type=villages&id="+elem.value,
			  success: function(results) {
			  	var target = $("#village");
			  	target.html("<option>-- Choose --</option>");
			  	$.each(results, function(i, result){
		           	target.append("<option value='"+result.id+"'>"+result.name+"</option>");
		        });
			  }
			});
		}


	</script>
</head>
<body>
	<form>
		Provinsi
		<select onchange="getRegencies(this)">
			<option>-- Choose --</option>
			<?php while ($row = mysqli_fetch_array($provinces)) {
				echo "<option value='".$row['id']."'>".$row['name']."</option>";
			} ?>
		</select>
		<br>

		Kota/Kabupaten
		<select onchange="getDistricts(this)" id="regency">
			<option>-- Choose --</option>
		</select>
		<br>

		Kecamatan
		<select onchange="getVillages(this)" id="district">
			<option>-- Choose --</option>
		</select>
		<br>

		Kelurahan
		<select id="village">
			<option>-- Choose --</option>
		</select>
	</form>
</body>
</html>