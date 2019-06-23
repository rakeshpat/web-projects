<?php
require_once '../classes/bodet-web-services.php';

$ws = new BodetWebServices('AbsenceTotalService');
$startDate = new DateTime('now');
$startDate->modify('-1 week');
$endDate = new DateTime('now');

$parameters = [
    'populationFilter' => '',
    'groupFilter' => '',
    'startDate' => $startDate->format('Y-m-d'),
    'endDate' => $endDate->format('Y-m-d')
];

$results = $ws->call('exportActualDailyAbsenceTotalsFromDateToDate', $parameters);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Bodet Web Services - Absence Total Service Example</title>

    <style>
        h4 { color:teal; }
    </style>
</head>

<body>

    <div class="jumbotron">
        <div class="container">
            <h1 class="font-weight-light">Bodet Web Services</h1>
            <h4 class="font-weight-bold">Absence Total Service Example</h4>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Absence type</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($results->exportedDailyAbsenceTotals->DailyAbsenceTotal as $v) { ?>
            <?php if ($v->typeDescription === 'Additional Break') continue; ?>
                <tr>
                    <td><?= $v->employeeFirstName.' '.$v->employeeSurname ?></td>
                    <td><?= $v->sectionDescription ?></td>
                    <td><?= $v->typeDescription ?></td>
                    <td><?= $v->date ?></td>
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