# Bodet Web Services
Examples of connecting to and using some of the web services from Bodet (Time &amp; Attendance).

Functions have been written under the BodetWebServices class which allow you to easily connect to a web service, output the available functions and the data that needs to be passed in to these functions, and output the results of the function call.

## Getting Started
#### Authentication
Connect to the web services ensuring correct credentials are entered in ***classes/auth.php***

In the example provided, I have entered the details found in the Web service usage example manual from Bodet Software where examples have been provided in Java.

```
public static $user = "wsuser";
public static $pass = "wsbodet";
public static $url = "localhost:8089";
```

If you are using a test server (localhost), you might need to change http**s** to http in ***classes/bodet-web-services.php***

#### Include resources
In a new file, include the bodet-web-services.php file (containing the BodetWebServices class)

```
<?php require_once 'classes/bodet-web-services.php' ?>
```

## Get the web service you require
#### List of web services
You can find a list of web services in http://localhost:8089/open/services (if you're using a test server) or through the cloud at https://example.bodet-software.com/open/services/?wsdl replacing example with the subdomain provided to you.

All web services are named in PascalCase ending with **Service** for example **EmployeeService**.

## Use the service
In your file, instantiate a new BodetWebServices object, passing the name of the web service as an argument:
```
$ws = new BodetWebServices('EmployeeService');
```

See the full list of functions and input and output types of the specified web service:
```
$ws->showAllFunctionsAndTypes();
```
```
Array
(
    [0] => exportEmployeeInformationsResponse exportEmployeeInformations(exportEmployeeInformations $parameters)
    [1] => deleteEmployeesResponse deleteEmployees(deleteEmployees $parameters)
    [2] => exportEmployeesListResponse exportEmployeesList(exportEmployeesList $parameters)
    [3] => importEmployeesResponse importEmployees(importEmployees $parameters)
    [4] => exportEmployeeInformationsForModuleResponse exportEmployeeInformationsForModule(exportEmployeeInformationsForModule $parameters)
    [5] => exportEmployeeInformationsListResponse exportEmployeeInformationsList(exportEmployeeInformationsList $parameters)
    [6] => exportEmployeesResponse exportEmployees(exportEmployees $parameters)
)
```
The first item of each array element shows the return type of each function, and the second item shows the method names along with signatures containing input types required.

A basic structure of the parameters to pass to the function can be displayed by calling **getParams($func)**:
```
$ws->getParams('exportEmployeeInformationsForModule');
```
```
$parameters = [
    'populationFilter' => string,
    'groupFilter' => string,
    'includeTandAModuleEmployees' => boolean,
    'includeAccessModuleEmployees' => boolean
]
```
In the above example, the type names e.g. string and boolean need to be replaced with values of that type.

## Invoke the function
Use the **call($func, $params)** function to invoke the SOAP function call and store the result:
```
$result = $ws->call('exportEmployeeInformationsForModules', $parameters);
```

## Examples
See the examples folder for examples of these web services in action.