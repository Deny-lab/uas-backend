<!DOCTYPE html>

<html>

<head>

    <!-- Begin Page Content -->

    <style>
        #signature {
            width: 300px;
            height: 200px;
            border: 1px solid black;
        }
    </style>

    <!-- <style>
    .kbw-signature {
        width: 400px;
        height: 200px;
    }

    #sig canvas {

        width: 100% !important;

        height: auto;

    }
</style> -->

   


                        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

                        <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">

                        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



                        <script type="text/javascript" src="asset/js/jquery.signature.min.js"></script>

                        <link rel="stylesheet" type="text/css" href="asset/css/jquery.signature.css">



                        <style>
                            .kbw-signature {
                                width: 400px;
                                height: 200px;
                            }

                            #sig canvas {

                                width: 100% !important;

                                height: auto;

                            }
                        </style>



</head>

<body>



    <div class="container">



        <form method="post" action="hehe">



            <h1>PHP Signature Pad Example - HDTuto.com</h1>



            <div class="col-md-12">

                <label class="" for="">Signature:</label>

                <br />

                <div id="sig"></div>

                <br />

                <button id="clear">Clear Signature</button>

                <textarea id="signature64" name="signed" style="display: none"></textarea>

            </div>



            <br />

            <button class="btn btn-success">Submit</button>

        </form>



    </div>



    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });

        $('#clear').click(function(e) {

            e.preventDefault();

            sig.signature('clear');

            $("#signature64").val('');

        });
    </script>



</body>

</html>