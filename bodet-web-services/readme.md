# Bodet Web Services
Examples of connecting to and using some of the web services from Bodet.

Functions have been written under the BodetWebServices class which allow you to easily connect to a web service, output the available functions and the data that needs to be passed in to these functions, and output the results of the function call.

### Getting Started
Connect to the web services ensuring correct credentials are entered in ***classes/auth.php***

In the example provided, I have entered the details found in the Web service usage example manual from Bodet Software where examples have been provided in Java.

```
public static $user = "wsuser";
public static $pass = "wsbodet";
public static $url = "localhost:8089";
```

If you are using a test server (localhost), you might need to change http**s** to http in ***classes/bodet-web-services.php***