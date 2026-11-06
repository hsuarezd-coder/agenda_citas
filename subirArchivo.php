<?php

$upload_dir = "uploads/";
if (isset($_FILES["reporte"])) {
    if ($_FILES["reporte"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
		$data = array(
            "id"     => "1",
            "mensaje"  => "Se subió correctamente el archivo."
        );
    } else {
		$prod=$_POST['nombre_archivo'];
		$filename=$_FILES["reporte"]["name"];
		$extension=end(explode(".", $filename));
		$newfilename=$prod .".".$extension;
        move_uploaded_file($_FILES["reporte"]["tmp_name"], $upload_dir . $newfilename);  
		$data = array(
            "id"     => "1",
            "mensaje"  => "Se subió correctamente el archivo.",
			"extension" => $extension
        );
		
    }
}
echo json_encode($data);
?>