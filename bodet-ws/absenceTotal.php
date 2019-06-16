<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$service = 'AbsenceTotalService';
require_once 'config/auth.php';

$dateFrom = new DateTime("now");
$dateFrom->modify("-1 week");
$dateTo = new DateTime("now");

$parameters = [
    'populationFilter' => '',
    'groupFilter' => '',
    'startDate' => $dateFrom->format('Y-m-d'),
    'endDate' => $dateTo->format('Y-m-d')
];

$results = $client->__soapCall('exportActualDailyAbsenceTotalsFromDateToDate', [
    'parameters' => $parameters
]);

?>

<table>
    <thead>
        <tr>
            <td>First Name</td>
            <td>Surname</td>
            <td>Department</td>
            <td>Absence Type</td>
            <td>Absence Date</td>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($results->exportedDailyAbsenceTotals->DailyAbsenceTotal as $value) {
            echo '<tr>';
            echo '<td>'.$value->employeeFirstName.'</td>';
            echo '<td>'.$value->employeeSurname.'</td>';
            echo '<td>'.$value->sectionDescription.'</td>';
            echo '<td>'.$value->typeDescription.'</td>';
            echo '<td>'.$value->date.'</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>