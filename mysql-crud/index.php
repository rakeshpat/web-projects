<?php
    require_once 'includes/crud.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700|Overpass+Mono&display=swap" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title>CRUD Operations</title>
    </head>

    <body>
        <header>
            <div class="container pt-4">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">CRUD</h1>
                    </div>
                </div>
            </div>

            <div class="container-fluid pb-3">
                <div class="row">
                    <div class="col">
                        <ul class="nav justify-content-center">
                            <li class="nav-item"><a class="nav-link" href="#">create</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">read</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">update</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <section id="about">
            <div class="container py-4">
                <div class="row">
                    <div class="col">
                        <h2>about</h2>
                        <p>This library allows an easy connection to be made to a database, and perform basic <strong>create</strong>, <strong>read</strong>, <strong>update</strong> and <strong>delete</strong> operations with <strong>minimal code</strong>.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="setup">
            <div class="container py-4">
                <div class="row">
                    <div class="col">
                        <h2>setup</h2>
                        <p>Modify the constructor of the <strong>DBConnect</strong> class in <strong>db_connection.php</strong> to set your host, username, password and database name.</p>
                        <div class="code">
                            public function __construct() {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;$this->host = '<em>localhost</em>';<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;$this->username = '<em>root</em>';<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;$this->password = '<em>root</em>';<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;$this->database = '<em>test</em>';<br>
                            }
                        </div>
                        <br>
                        <p>Include <strong>crud.php</strong> in your project</p>
                        <div class="code">
                            require_once 'includes/crud.php';
                        </div>
                        <br>
                        <p>and instantiate a CRUD object</p>
                        <div class="code">
                            $obj = new CRUD();
                        </div>
                        <br>
                        <p>That's it! Now you can use the <a href="#">create</a> <a href="#">read</a> <a href="#">update</a> and <a href="#">delete</a> functions</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="read">
            <div class="container mt-5">
                <div class="row">
                    <div class="col pt-5">
                        <h3>CREATE</h3>
                        <p>Create a record into a table using the <code>insert</code> function.</p>
                        <div class="code">
                            $obj->insert('table_name', ['field1', 'field2', 'field3'], ['Value 1', 'Testing', 123]);
                        </div>
                        <br>
                        <p>The example above inserts a record into the table <code>table_name</code>, adding values in the third parameter to the fields in the first parameter.</p>
                        <p>If you have many fields/values to add, you may wish to use a variable to store the arrays and pass them into the function as shown below.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="code">
                            $fields = [<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;'name',<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;'address',<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;'postcode',<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;'email'<br>
                            ]
                        </div>
                    </div>
                    <div class="col">
                        <div class="code">
                            $values = [<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;'Joe Bloggs',<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;'123 Fake Street',<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;'FT12 3FT',<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;'junk@mail.com'<br>
                            ]
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col pt-3">
                        <div class="code">
                            $obj->insert('customers', $fields, $values);
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="update"></section>
        <section id="delete"></section>




        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>