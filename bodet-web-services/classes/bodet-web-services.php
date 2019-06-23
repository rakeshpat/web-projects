<?php

require_once 'auth.php';

class BodetWebServices {

    private $client;

    public function __construct($webService) {
        try {
            $this->client = new SoapClient(
                'https://'.BodetAuth::$user.':'.BodetAuth::$pass.'@'.BodetAuth::$url.'/open/services/'.$webService.'?wsdl', [
                    'login' => BodetAuth::$user,
                    'password' => BodetAuth::$pass
                ]
            );
        } catch (Exception $e) {
            echo '<pre>'.$e.'</pre>';
            exit();
        }
    }

    /*
     * Displays all functions and its input/output types of the specified web service
     */
    public function showAllFunctionsAndTypes() {
        echo '<pre>';

        echo '<span style="color:lightseagreen; font-weight:bold;">Functions</span><br><br>';
        print_r($this->client->__getFunctions());
        echo '<br>---<br><br>';

        echo '<span style="color:lightseagreen; font-weight:bold;">Types</span><br><br>';
        print_r($this->client->__getTypes());

        echo '</pre>';
    }

    /*
     * Displays the parameters needed to pass into the SOAP call function
     * @param string $func Function of the web service to get parameters for
     */
    public function getParams($func) {
        $success = false;

        try {
            $functions = $this->client->__getFunctions();
            $types = $this->client->__getTypes();

            foreach ($functions as $function) {
                preg_match('/\ (.*)\(/', $function, $method);

                if ($func === $method[1]) {
                    preg_match('/\((.*)\ /', $function, $argument);

                    foreach ($types as $type) {
                        preg_match('/'.$argument[1].'\ /', $type, $struct);

                        if ($argument[1] === trim($struct[0])) {
                            $output = preg_split('/\r\n|\n|\r/', $type);
                            $output[0] = str_replace('struct '.$argument[1].' {', '$parameters = [', $output[0]);

                            for ($i = 1; $i < count($output) - 1; $i++) {
                                $property = explode(' ',$output[$i]);
                                $output[$i] = '    \''.substr($property[2], 0, -1).'\' =&gt; <span style="color:lightseagreen; font-style:italic;">'.$property[1].'</span>';
                                if ($i !== count($output) - 2) {
                                    $output[$i] .= ',';
                                }
                            }

                            $output[count($output) - 1] = '];';

                            $output = implode('<br>', $output);
                            echo '<pre>'.$output.'</pre>';

                            $success = true;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo '<pre>'.$e.'</pre>';
        }

        if ($success === false) {
            echo '<pre>The function '.$func.' is not a part of this web service.</pre>';
        }
    }

    /*
     * Returns the result of the SOAP function call
     * @param string $func Function to invoke
     * @param array $params Parameters to pass to the function to invoke
     */
    public function call($func, $params) {
        try {
            return $this->client->__soapCall($func, [
                'parameters' => $params
            ]);
        } catch (Exception $e) {
            echo '<pre>'.$e.'</pre>';
            exit();
        }
    }

}