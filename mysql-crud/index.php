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
                            <li class="nav-item"><a class="nav-link" href="#create">CREATE</a></li>
                            <li class="nav-item"><a class="nav-link" href="#read">READ</a></li>
                            <li class="nav-item"><a class="nav-link" href="#update">UPDATE</a></li>
                            <li class="nav-item"><a class="nav-link" href="#delete">DELETE</a></li>
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
                        <p>That's it! Now you can use the <a href="#create">create</a> <a href="#read">read</a> <a href="#update">update</a> and <a href="#delete">delete</a> functions</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="create">
            <div class="container pt-5">
                <div class="row">
                    <div class="col pt-5">
                        <h3>CREATE</h3>
                        <p>Create a record into a table using the <code>insert</code> function.</p>
                        <div class="code">
                            $obj->insert('customers', ['name', 'address', 'postcode'], ['Joe Bloggs', '123 Fake Street', 'FT12 3FT']);
                        </div>
                        <br>
                        <p>The example above inserts a record into the table <code>table_name</code>, adding values in the third parameter to the fields in the second parameter.</p>
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
                    <div class="col pt-3 pb-5">
                        <div class="code">
                            $obj->insert('customers', $fields, $values);
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="read">
            <div class="container pt-5">
                <div class="row">
                    <div class="col pt-5">
                        <h3>READ</h3>
                        <p>Reads data from a table using the <code>select</code> function.</p>
                        <div class="code">
                            $obj->select('orders', 'order_id', ['customer_name', 'item_desc', 'qty']);
                        </div>
                        <br>
                        <p>The example above selects the fields in the third parameter of the <code>order</code> table.</p>
                        <p><br><em>Why is the primary key name required in parameter 2?</em></p>
                        <p>You may require a way of identifying a specific record when the results are obtained. Unique primary key values will allow for any specific record to be captured.</p>
                        <p><br><em>How do I see the results?</em></p>
                        <p>A results variable can be used to get the results of the query as shown below.</p>
                        <div class="code">
                            $results = $obj->select('contacts', 'contact_id', ['name', 'address', 'contact_no']);
                        </div>
                        <br>
                        <p>Retrieving a value from the table</p>
                        <div class="code">
                            echo $results[9]['name'];
                        </div>
                        <br>
                        <p class="pb-5">The example above will output the value in the <code>name</code> field where the <code>contact_id</code> is <code>9</code>.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="update">
            <div class="container pt-5">
                <div class="row">
                    <div class="col pt-5">
                        <h3>UPDATE</h3>
                        <p>Updates an existing record using the <code>update</code> function.</p>
                        <div class="code">
                            $obj->update('items', ['in_stock'], [0], ['qty', 'supplier'], [0, 'none'];
                        </div>
                        <br>
                        <p>The code in the example above sets all <code>in_stock</code> field values to <code>0</code> where <code>qty</code> is <code>0</code> and <code>supplier</code> is <code>none</code> in the <code>items</code> table.</p>
                        <p class="pb-5">Parameters 2, 3, 4 and 5 are all arrays and can store many elements. This means you are able to set several values and add several conditions with one statement!</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="delete">
            <div class="container pt-5">
                <div class="row">
                    <div class="col pt-5">
                        <h3>DELETE</h3>
                        <p>Removes a record from a specified table using the <code>delete</code> function.</p>
                        <div class="code">
                            $obj->delete('orders', ['id'], [159]);
                        </div>
                        <br>
                        <p>The above code will remove the record where <code>id</code> is <code>159</code> from the <code>delete</code> table.</p>
                        <p class="pb-5">Note that the second and third parameters are arrays, so several conditions can be added.</p>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

        <script>
            $('a[href*=\\#]:not([href$=\\#])').click(function() {
                event.preventDefault();

                $('html, body').animate({
                    scrollTop: $($.attr(this, 'href')).offset().top
                }, 'slow');
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>