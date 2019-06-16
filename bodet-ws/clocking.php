<?php

require_once 'config/auth.php';

$service = 'ClockingService';

$populationFilter = '';
$groupFilter = '';
$date = new DateTime('now');

$parameters = [
    'populationFilter' => '',
    'groupFilter' => '',
    'startDate' => $date->format('Y-m-d'),
    'endDate' => $date->format('Y-m-d')
];

$results = $client->__soapCall('exportClockingsByDate', [
    'parameters' => $parameters
]);

?>

<table>
    <thead>
        <tr>
            <td>First Name</td>
            <td>Surname</td>
            <td>Time</td>
            <td>Clocked In/Out</td>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($results->exportedClockings->Clocking as $value) {
            echo '<tr>';
            echo '<td>'.$value->employeeFirstName.'</td>';
            echo '<td>'.$value->employeeSurname.'</td>';
            echo '<td>'.$value->time.'</td>';
            echo '<td>'.$value->inOutIndicator.'</td>';
            echo '</tr>';
        }
    ?>
    </tbody>
</table>
