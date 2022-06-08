<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DrugDB</title>

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
            <div>
        </div>

        <div class="links">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ url('search') }}">Search</a>
                    <a href="{{ url('section/approveddrugs') }}">Approved Drugs</a>
                    <a href="{{ url('section/drugtargets') }}">Drug Targets</a>
                    <a href="{{ url('section/targetsequences') }}">Target Sequences</a>
        </div>
                    
        <div align="center">
            <!-- Description -->
            <table width="70%" border="0" align="center"><tr align="center"><td align="center"></br></br>The DrugDB database allow searching for approved drugs and their targets. All data are obtained from DrugBank.</br></br></td><tr></table>

            <table width="70%"><tr>
                <td style="border:1px solid grey;"><b></br><center>SEARCH A DRUG</center></b></br>
                <!-- ~~~~~~~~~~~ search drug using an id ~~~~~~~~~~~  -->
                <center>
                <form method="post" action="{{ url('/drugsearch/id') }}">
                @csrf
                <font size="2" class="a"><b>Search by drug name / DrugBank ID / HET ID / PubChem ID :</b></font>
                <input type="text" name="id" id="id" placeholder="e.g DB00398 / BAX / 46505329" style="width: 200px;">
                <input type="submit" name="submit" value="Submit"> <font size="2" class="a"></font>
                </form></br></center>

                <!--  ~~~~~~~~~~~ search drug using an indication ~~~~~~~~~~~   -->
                <center>
                <form method="post" action="{{ url('/drugsearch/indication') }}">
                @csrf
                <font size="2" class="a"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search by drug indication / disease :</b></font>
                <input type="text" name="indication" id="indication" placeholder="e.g diabetes" style="width: 200px;">
                <input type="submit" name="submit" value="Submit"> <font size="2" class="a"></font>
                </form></br></center>

                </td></tr>
                <tr><td style="border:1px solid grey;"><b></br><center>SEARCH A TARGET</center></b></br>

                <!--  ~~~~~~~~~~~ search target using drug id ~~~~~~~~~~~   -->
                <center>
                <form method="post" action="{{ url('/targetsearch/drugid') }}">
                @csrf
                <font size="2" class="a"><b>Search by drug</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Name / DrugBank ID / HET ID / PubChem ID) :</b></font>
                <input type="text" name="drugid" id="drugid" placeholder="e.g DB00398 / sorafenib / BAX / 46505329" style="width: 260px;">
                <input type="submit" name="submit" value="Submit"> <font size="2" class="a"></font>
                </form></br></center>

                <!--  ~~~~~~~~~~~ search target using protein id ~~~~~~~~~~~   -->
                <center>
                <form method="post" action="{{ url('/targetsearch/proteinid') }}">
                @csrf
                <font size="2" class="a"><b>Search by protein or gene name / ID</br>(Name / UniProt Title / GeneBank / UniPort / PDB) :</b></font>
                <input type="text" name="proteinid" id="proteinid" placeholder="e.g 297050 / X69878 / P35916 / 4BSJ" style="width: 260px;">
                <input type="submit" name="submit" value="Submit"> <font size="2" class="a"></font>
                </form></br></center>

                <!--  ~~~~~~~~~~~ search target using organism ~~~~~~~~~~~   -->
                <center>
                <form method="post" action="{{ url('/targetsearch/species') }}">
                @csrf
                <font size="2" class="a"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search by organism &nbsp;:</b></font>
                <input type="text" name="species" id="species" placeholder="e.g human" style="width: 260px;">
                <input type="submit" name="submit" value="Submit"> <font size="2" class="a"></font>
                </form></br></center>

                <!--  ~~~~~~~~~~~ search target by sequences ~~~~~~~~~~~   -->
                <center>
                <form method="post" action="{{ url('/targetsearch/sequence') }}">
                @csrf
                <font size="2" class="a"><b>Search by sequence&nbsp;(fragment or complete sequence of protein / gene)&nbsp;</b></font></br>
                <!--input type="text" name="sequence" id="sequence" placeholder="sequence" style="width: 100px;"-->
                <textarea name="sequence" rows="4" cols="70">Insert sequence.</textarea></br>
                <input type="submit" name="submit" value="Submit"> <font size="2" class="a"></font>
                </form></br></center>
                </td>
            </tr></table></br>
        </div>
    </body>
</html>
