<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <script src=//code.jquery.com/jquery.js></script>
        <script src=//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js></script>
        <title>Drug Targets</title>

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
                align: center;
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
<center></br><b>Results: List of drug targets  bound to {{$keyword}} = {{$drugbankid}}</b></center>
                <table id="mytable" class="display compact" style="width:100%"><thead><tr>
                    <th class="text-center">Pharmaco-</br>logically active</th>
                    <th class="text-center">Protein name</th>
                    <th class="text-center">Gene name</th>
                    <th class="text-center">GeneBank Protein ID</th>
                    <th class="text-center">GeneBank Gene ID</th>
                    <th class="text-center">Uniprot Title</th>
                    <th class="text-center">PDBIDs</th>
                    <th class="text-center">Species</th>
                    <th class="text-center">View</th>
                    </tr></thead>
                <tbody>
                @foreach($results as $d)
                <tr>
                    <td class="text-center">{{$d->pharmaactive}}</td>
                    <td class="text-center">{{$d->proteinname}}</td>
                    <td class="text-center">{{$d->genename}}</td>
                    <td class="text-center">{{$d->gbproteinid}}</td>
                    <td class="text-center">{{$d->gbgeneid}}</td>
                    <td class="text-center">{{$d->uniprottitle}}</td>
                    <td class="text-center">{{$d->pdbids}}</td>
                    <td class="text-center">{{$d->species}}</td>
                    <td class="text-center"><button type="button" onclick="location.href='{{ url('targetsearch/viewtarget',[$d->uniprotid]) }}'">View</button></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot><tr>
                    <th class="text-center">Pharmacologically active</th>
                    <th class="text-center">Protein name</th>
                    <th class="text-center">Gene name</th>
                    <th class="text-center">GeneBank Protein ID</th>
                    <th class="text-center">GeneBank Gene ID</th>
                    <th class="text-center">Uniprot Title</th>
                    <th class="text-center">PDBIDs</th>
                    <th class="text-center">Species</th>
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
