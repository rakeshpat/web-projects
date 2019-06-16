<?php

$service = 'EmployeeService';
require_once 'config/auth.php';

$date = new DateTime("now");

$parameters = [
    'populationFilter' => [
        'AskedPopulation' => [
            'populationStartDate' => $date->format('Y-m-d'),
            'populationEndDate' => $date->format('Y-m-d'),
            'groupFilter' => '',
            'populationFilter' => '',
            'populationMode' => 0
        ]
    ]
];

$results = $client->__soapCall('exportEmployeesList', [
    'parameters' => $parameters
]);

?>

<table>
    <thead>
        <tr>
            <td>First Name</td>
            <td>Surname</td>
            <td>Email</td>
            <td>Department</td>
            <td>Personal Workspace Profile Description</td>
            <td>Absence Validator</td>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($results->exportedEmployees->Employee as $employee) {
            echo '<tr>';
            echo '<td>'.$employee->firstName.'</td>';
            echo '<td>'.$employee->surname.'</td>';
            echo '<td>'.$employee->recipientsEmail.'</td>';
            echo '<td>'.$employee->currentSectionDescription.'</td>';
            echo '<td>'.$employee->personalWorkspaceProfileDescription.'</td>';
            echo '<td>'.$employee->absenceValidator.'</td>';
            echo '</tr>';
        }
    ?>
    </tbody>
</table>
