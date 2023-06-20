<?php

$search_category= $_POST["search"];
$search_area= $_POST["area"];


if(isset($_POST["search"]) && isset($_POST["area"])){

//echo $search_category;
//echo $search_area;

//Connect to database
$host= "localhost";
$dbuser= "root";
$dbpass= "";
$dbname= "doctor";

$conn=new mysqli($host, $dbuser, $dbpass, $dbname);

$sql= "SELECT ID, DoctorName, DoctorInformation, DoctorImage from doctors
        where DoctorCategory like '%".$search_category."%' and 
         DoctorArea like '%".$search_area."%'  ";

$result= $conn->query($sql);

$data='<b class="servicesectiontitle">Doctors found in your area.</b>';

$doctor_data="";

if($result->num_rows > 0){
  $doctor_data=$doctor_data.'<div class="horizontal-scroll-wrapper">';

  while($row = $result->fetch_assoc()){
        $doctorid= $row["ID"];
        $doctorname= $row["DoctorName"];
        $doctorinfo= $row["DoctorInformation"];
        $doctorimage= $row["DoctorImage"];

        $doctor_data=$doctor_data.'<div class="doctor-card">
                                    <img
                                      class="doctorimg"
                                      alt=""
                                      src="'.$doctorimage.'"
                                    />
                                    <b class="doctorname">'.$doctorname.'</b>
                                    <b class="doctorinfo">'.$doctorinfo.'</b>
                                  </div>';
    }

  $doctor_data=$doctor_data.'</div>';
    

}else{
    $data='<b class="servicesectiontitle">No Doctor found in your area.</b>';
}

}else{
    $data='<div class="servicesectiontitle">Bad Query</div>';
}

$data=$data.$doctor_data;
echo $data;
?>