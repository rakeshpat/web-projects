<?php
require_once '../classes/bodet-web-services.php';

$ws = new BodetWebServices('EmployeeService');
$date = new DateTime('now');

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

$results = $ws->call('exportEmployeesList', $parameters);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Bodet Web Services - Employee Service Example</title>

    <style>
        h4 { color:teal; }
    </style>
</head>

<body>

    <div class="jumbotron">
        <div class="container">
            <h1 class="font-weight-light">Bodet Web Services</h1>
            <h4 class="font-weight-bold">Employee Service Example</h4>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Personal workspace profile description</th>
                    <th>Absence validator</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($results->exportedEmployees->Employee as $v) { ?>
                <tr>
                    <td><?= $v->firstName.' '.$v->surname ?></td>
                    <td><?= $v->recipientsEmail ?></td>
                    <td><?= $v->currentSectionDescription ?></td>
                    <td><?= $v->personalWorkspaceProfileDescription ?></td>
                    <td><?= $v->absenceValidator ?></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>