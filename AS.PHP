<?php
 
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
 
$response = file_get_contents($URL);

 
if ($response === FALSE) {
    die('Error occurred while retrieving data.');
}
 
 
$data = json_decode($response, true);

 
if ($data === NULL) {
    die('Error decoding JSON data.');
}

 
//echo '<pre>';
//print_r($data);  
//echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationality Data</title>
    <link rel="stylesheet" href="https://unpkg.com/picocss/dist/pico.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 3px solid #91e3ee;  
      
    
    font: size 2px;
        }

        th {
            background-color: pink;
        }
        td{
            background-color: #dcfa97;
        }
        h1{
            color:#a4d3f3;
        }
        body {
            background-color: #fdfb90;}

        @media (max-width: 600px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>

<h1>UOB Student Enrollment by Nationality</h1>

<table>
    <thead>
        <tr>
            <th>Year</th>
            <th>Semester</th>
            <th> The Programs</th>
            <th>Nationality</th>
            <th>Colleges</th>
            <th>Number of Students</th>

             
        </tr>
    </thead>
    <tbody>
        <?php
         
        if (isset($data['results']) && is_array($data['results'])) {
        
            foreach ($data['results'] as $record) {
            
                if (isset($record['year']) && isset($record['semester']) && isset($record['the_programs']) && isset($record['nationality']) && isset($record['colleges']) && isset($record['number_of_students'])) {
                   
                
                
    
}

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($record['year']) . "</td>";
                    echo "<td>" . htmlspecialchars($record['semester']) . "</td>";
                    echo "<td>" . htmlspecialchars($record['the_programs']) . "</td>";
            
                    echo "<td>" . htmlspecialchars($record['nationality']) . "</td>";
                    echo "<td>" . htmlspecialchars($record['colleges']) . "</td>";
                    echo "<td>" . htmlspecialchars($record['number_of_students']) . "</td>";
                    echo "</tr>";
                }
            }
         else {
            echo "<tr><td colspan='2'>No data available or the structure is different than expected.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>



