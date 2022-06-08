<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <script src=//code.jquery.com/jquery.js></script>
        <script src=//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js></script>
        <title>Approved Drugs</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            tfoot input {
                width: 100%;
                align: enter;
                padding: 3px;
                box-sizing: border-box;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    DrugDB
                </div>

                <div class="links">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ url('search') }}">Search</a>
                    <a href="{{ url('section/approveddrugs') }}">Approved Drugs</a>
                    <a href="{{ url('section/drugtargets') }}">Drug Targets</a>
                    <a href="{{ url('section/targetsequences') }}">Target Sequences</a>
                </div>

                <center><div style="width: 90%;" align="center">
<center></br><b>Results: List of approved drugs that match the keyword {{$keyword}}</b></center>
                <table id="mytable" class="display compact" style="width:100%"><thead><tr>
                    <th class="text-center">DrugBank ID</th>
                    <th class="text-center">Drug name</th>
                    <th class="text-center">Drug Type</th>
                    <th class="text-center">Indication</th>
                    <th class="text-center">PubChem ID</th>
                    <th class="text-center">HET ID</th>
                    <th class="text-center">View</th>
                    
                </tr></thead>
                <tbody>
                @foreach($results as $d)
                <tr>
                    <td class="text-center">{{$d->drugbankid}}</td>
                    <td class="text-center">{{$d->drugname}}</td>
                    <td class="text-center">{{$d->drugtype}}</td>
                    <td class="text-center">{{$d->indication}}</td>
                    <td class="text-center">{{$d->pubchemid}}</td>
                    <td class="text-center">{{$d->hetid}}</td>
                    <td class="text-center"><button type="button" onclick="location.href='{{ url('drugsearch/viewdrug',[$d->drugbankid]) }}'">View</button></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot><tr>
                    <th class="text-center">DrugBank ID</th>
                    <th class="text-center">Drug name</th>
                    <th class="text-center">Drug Type</th>
                    <th class="text-center">Indication</th>
                    <th class="text-center">PubChem ID</th>
                    <th class="text-center">HET ID</th>
                    <th class="text-center">View</th>
                </tr></tfoot>
                </table></br>
                </div></center>
                    
            </div>
        </div>
<script>

$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#mytable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search" />' );
    } );
 
    // DataTable
    var table = $('#mytable').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
 
} );

</script>

    </body>
</html>
