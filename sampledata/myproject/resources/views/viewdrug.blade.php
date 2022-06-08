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
            
            .button {
              background-color: #4CAF50; /* Green */
              border: none;
              color: white;
              padding: 15px 32px;
              width: 250px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              cursor: pointer;
            }
            .button1 {background-color: #4CAF50;} /* Blue */
            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #555555;} /* Black */
            .buttonx {
              text-decoration: none;
              background-color: #EEEEEE;
              color: #333333;
              padding: 2px 6px 2px 6px;
              border-top: 1px solid #CCCCCC;
              border-right: 1px solid #333333;
              border-bottom: 1px solid #333333;
              border-left: 1px solid #CCCCCC;
            }
            a:hover {
                  text-decoration: none;
            }
                
            .wrapper-1 {
              width: 90%;
            }
        </style>
    </head>
    <body>
        <div class="full-height">
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
                <center><div class="wrapper-1">
                    @php
                        $cid = $first->pubchemid;
                        $linkimg = 'https://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?cid='.'$cid'.'&t=l'
                    @endphp
                </br>
                <table align="center" width="60%"><tr align="center">
                    <td align="center" width="30%"><img src="https://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?cid={{$first->pubchemid}}&t=l" alt="ligand"></td>
                    <td align="center" width="30%">
                        <h4><b>{{$first->drugname}}</b></h4>
                        <i>{{$first->drugtype}}</i></br>
                <a class="button button1" href="https://go.drugbank.com/drugs/{{$first->drugbankid}}">Drugbank: {{$first->drugbankid}}</a></br>
                <a class="button button2" href="https://pubchem.ncbi.nlm.nih.gov/compound/{{$first->pubchemid}}">PubChem: {{$first->pubchemid}}</a>
                        @php
                            $het = $first->hetid;
                if (strlen(trim($first->hetid)) == 3){echo '</br><a class="button button3" href="https://www.ebi.ac.uk/pdbe-srv/pdbechem/chemicalCompound/show/'.$het.'">PDB: '.$het.'</a>';}
                            else {}
                        @endphp
                    </td>
                </tr>
                <tr align="center"><td colspan="2"></br><b>Indication:</b></br>{!! $first->indication !!}</td></tr>
                </table>
                </br></br><h4><b>Protein targets for {{$first->drugname}}</h4></b></br>
                
                
                <table id="mytable" class="display compact" style="width:100%"><thead><tr>
                    <th class="text-center">Pharmaco-</br>logical action</th>
                    <th class="text-center">Protein name</th>
                    <th class="text-center">Gene name</th>
                    <th class="text-center">GeneBank Protein ID</th>
                    <th class="text-center">GeneBank Gene ID</th>
                    <th class="text-center">Uniprot ID</th>
                    <th class="text-center">Uniprot Title</th>
                    <th class="text-center">PDBIDs</th>
                    <th class="text-center">Species</th>
                    <th class="text-center">View</th>
                    </tr></thead>
                <tbody>
                @foreach($results as $d)
                    @php
                        $pharmaactive = $d->pharmaactive;
                        if ($pharmaactive == "P"){$pa = "Yes";}
                        if ($pharmaactive == "N"){$pa = "No";}
                    @endphp
                <tr>
                    <td class="text-center">{{$pa}}</td>
                    <td class="text-center">{{$d->proteinname}}</td>
                    <td class="text-center">{{$d->genename}}</td>
                    <td class="text-center">{{$d->gbproteinid}}</td>
                    <td class="text-center">{{$d->gbgeneid}}</td>
                    <td class="text-center">{{$d->uniprotid}}</td>
                    <td class="text-center">{{$d->uniprottitle}}</td>
                    @php
                    if (strlen(trim($d->pdbids)) !=0) {
                        echo '<td class="text-center"><a href="https://www.ebi.ac.uk/pdbe/pdbe-kb/proteins/'.$d->uniprotid.'">View PDB</a></td>';}
                    else {echo '<td>-</td>';}
                    @endphp
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
                    <th class="text-center">Uniprot ID</th>
                    <th class="text-center">Uniprot Title</th>
                    <th class="text-center">PDBIDs</th>
                    <th class="text-center">Species</th>
                    <th class="text-center">View</th>
                </tr></tfoot>
                    </table></br>
                </div></center>
                
                
                
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
