<?php 

	if (isset($_GET['type']) && isset($_GET['id'])) {
		$id 	= $_GET['id'];
		$type 	= $_GET['type'];

		$conn = mysqli_connect('localhost','root','','db_belajar');

		$result = "";
		switch ($type) {
			case 'provinces':
				$result = provinces($conn);
				break;

			case 'regencies':
				$result = regencies($conn, $id);
				break;

			case 'districts':
				$result = districts($conn, $id);
				break;

			case 'villages':
				$result = villages($conn, $id);
				break;

			default : 
				$result = notFound();
				break;
		}

		header('Content-Type: application/json');
		echo $result;
	}

	function provinces($conn) {
		$sql = "SELECT id,name FROM provinces";
		$rows = mysqli_query($conn, $sql);

		$provinces = array();
		while ($row = mysqli_fetch_array($rows)) {
			$provinces[] = array(
				"id" 	=> $row['id'],
				"name" 	=> $row['name']
			);
		}
		mysqli_close($conn);
		return json_encode($provinces);		
	}

	function regencies($conn, $province_id){
		$sql = "SELECT id,name FROM regencies WHERE province_id='".$province_id."'";
		$rows = mysqli_query($conn, $sql);

		$regencies = array();
		while ($row = mysqli_fetch_array($rows)) {
			$regencies[] = array(
				"id" 	=> $row['id'],
				"name" 	=> $row['name']
			);
		}
		mysqli_close($conn);
		return json_encode($regencies);
	}

	function districts($conn, $regency_id){
		$sql = "SELECT id,name FROM districts WHERE regency_id='".$regency_id."'";
		$rows = mysqli_query($conn, $sql);

		$districts = array();
		while ($row = mysqli_fetch_array($rows)) {
			$districts[] = array(
				"id" 	=> $row['id'],
				"name" 	=> $row['name']
			);
		}
		mysqli_close($conn);
		return json_encode($districts);
	}

	function villages($conn, $district_id){
		$sql = "SELECT id,name FROM villages WHERE district_id='".$district_id."'";
		$rows = mysqli_query($conn, $sql);

		$villages = array();
		while ($row = mysqli_fetch_array($rows)) {
			$villages[] = array(
				"id" 	=> $row['id'],
				"name" 	=> $row['name']
			);
		}
		mysqli_close($conn);
		return json_encode($villages);
	}

	function notFound(){
		$message = array("code" => "404", "message"=>"type not found");
		return json_encode($message);
	}


?>