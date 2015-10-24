<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!DOCTYPE html>
<html>
<head>
<h2>A T E S T</h2>
    <style>
        @page { margin: 20px 40px; }        
    </style>
</head>

<body>
    <div id="page-wrapper">
    <div class="container-fluid">
        <h2> Selection Report</h2>
        <h4>Report ID: {{$report->id}}</h4>
        <input type="hidden" name="reportid" value={{$report->id}}>
            <div>
                <p style="text-align:right">Selection Report ID: {{ $selection->id }}</p>
                <p style="text-align:right"> Client: {{ $clientname }} </p>
                <p style="text-align:right"> Practitioner-in-charge: {{ $pracname }}</p>
            </div>
        <hr>

        @foreach($answerlist as $reportinfo)
        <div white-space="pre-line">
            @foreach($reportinfo as $reportlist)
                <h4>{{ $reportlist->question }}</h4>
                <p>{{ $reportlist->pivot->answers}}<p>                
                <p></p>             
                <hr>
            @endforeach          
        </div>
        @endforeach
    
    </div>
    </div>
</body>
</html>
