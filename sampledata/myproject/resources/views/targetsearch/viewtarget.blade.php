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
              width: 300px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              cursor: pointer;
            }
            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #8E8B93;} /* Black */
            .button4 {background-color: #FF33E3;} /* Magenta */
            .button5 {background-color: #F79520;} /* Orange */
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
                <center><div class="wrapper-1"></br>
                @php
                if (strlen(trim($reppdb)) != 0){
                    $reptwo = strtolower(substr($reppdb,1,-1));
                    $linkimg = 'https://cdn.rcsb.org/images/structures/'.$reptwo.'/'.strtolower($reppdb).'/'.strtolower($reppdb).'_assembly-1.jpeg';
                    echo '<table align="center" width="60%"><tr align="center">';
                    echo '<td align="center" width="30%"><img src="'.$linkimg.'" alt="ligand" width="400px" height="400px"></td>';
                    echo '<td align="center" width="30%">';
                    echo '<b>'.$first->proteinname.'</b></br>';
                    echo '<i>'.$first->genename.'</i> | '.$first->uniprottitle.'</br>';
                    if ($first->pharmaactive == 'P'){echo '<i>Pharmacologically active</i></br>';}
                    if ($first->pharmaactive == 'N'){echo '<i>Unknown Pharmacological Action</i></br>';}
                    echo '<a class="button button1" href="http://www.uniprot.org/uniprot/'.$uniprotid.'">Uniprot: '.$uniprotid.'</a>';
                    echo '<a class="button button2" href="https://go.drugbank.com/polypeptides/'.$uniprotid.'">DrugBank: '.$uniprotid.'</a>';
                    if (strlen(trim($first->gbproteinid)) != 0){echo '</br><a class="button button3" href="https://www.ncbi.nlm.nih.gov/entrez/viewer.fcgi?val='.$first->gbproteinid.'">GeneBank (protein): '.$first->gbproteinid.'</a>';}
                    if (strlen(trim($first->gbgeneid)) != 0){echo '</br><a class="button button4" href="https://www.ncbi.nlm.nih.gov/entrez/viewer.fcgi?val='.$first->gbgeneid.'">GeneBank (gene): '.$first->gbgeneid.'</a>';}
                    echo '</br><a class="button button5" href="https://www.ebi.ac.uk/pdbe/pdbe-kb/proteins/'.$uniprotid.'">Go to PBD</a>';
                    echo '</td></tr></table>';
                }
                else{
                    echo '<b>'.$first->proteinname.'</b></br>';
                    echo '<i>'.$first->genename.'</i> | '.$first->uniprottitle.'</br>';
                    if ($first->pharmaactive == 'P'){echo '<i>Pharmacologically active</i></br>';}
                    if ($first->pharmaactive == 'N'){echo '<i>Unknown Pharmacological Action</i></br>';}
                    echo '<a class="button button1" href="http://www.uniprot.org/uniprot/'.$uniprotid.'">Uniprot: '.$uniprotid.'</a>';
                    echo '</br><a class="button button2" href="https://go.drugbank.com/polypeptides/'.$uniprotid.'">DrugBank: '.$uniprotid.'</a>';
                    if (strlen(trim($first->gbproteinid)) != 0){echo '</br><a class="button button3" href="https://www.ncbi.nlm.nih.gov/entrez/viewer.fcgi?val='.$first->gbproteinid.'">GeneBank (protein): '.$first->gbproteinid.'</a>';}
                    if (strlen(trim($first->gbgeneid)) != 0){echo '</br><a class="button button4" href="https://www.ncbi.nlm.nih.gov/entrez/viewer.fcgi?val='.$first->gbgeneid.'">GeneBank (gene): '.$first->gbgeneid.'</a>';}
                }
                @endphp
                </br><h4><b>Drug molecules bound to {{$first->proteinname}} ({{$uniprotid}}})</h4></b>
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
                    @php
                        if ($d->drugtype =="BiotechDrug"){$drugtype = "Biotech";}
                        elseif ($d->drugtype =="SmallMoleculeDrug"){$drugtype = "Small Molecule";}
                        else {$drugtype = $d->drugtype;}
                    @endphp
                    <td class="text-center">{{$drugtype}}</td>
                    <td class="text-center">{!! $d->indication !!}</td>
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
