<?php
$conn = mysqli_connect("localhost","root","","rest_api");
$request = $_SERVER['REQUEST_METHOD'];
$data = array();
switch ($request) {
	case 'GET':
		response(getData());
		break;
	case 'POST':
		response(addData());
		break;
	default:
		# code...
		break;
}

function getData(){
	global $conn;
	if(@$_GET['id']){
		@$id = $_GET['id'];
		$where ='group by department desc';
	}else{
		$id=0;
		$where ='';
	}
	$query = mysqli_query($conn ,"select department ,count(*) as no_of_employee from rest_api.employee".$where);
	while($row = mysqli_fetch_assoc($query)) {
		$data[] = array('No of Employee'=>$row['no_of_employee'],'department'=>$row['department']);
	}
	return $data;
}

function addData(){
	global $conn;

	$query_insert = mysqli_query($conn,"insert into rest_api.employee(employee_name,department)values('vijay','IT'),('satyam','sales'),('sagar','Tech support'),('vikram','marketing'),('vivek','IT'),('sanjeev','IT'),('sarthak','sales'),('yash','Tech support'),('Ankit','marketing'),('vineet','IT')");
	if(query_insert == true){
		$data[] = array('message'=> 'Created');
	}else{
		$data[] = array('message'=>'Not Created !');
	}
	return $data;
}


function response($data){
	echo json_encode($data);
}

?>