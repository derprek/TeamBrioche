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
        <h2> Assessment Report</h2>
        <h4>Report ID: {{$report->id}}</h4>
        <input type="hidden" name="reportid" value={{$report->id}}>
            <div>
                <p style="text-align:right"> Client's name: {{ $clientinfo->fname}} {{ $clientinfo->sname}} </p>
                <p style="text-align:right"> Practitioner-in-charge: {{ $pracinfo->fname }} {{ $pracinfo->sname}}</p>
                <p style="text-align:right"> Report Conducted by: {{ $creator_practitioner->fname }} {{ $creator_practitioner->sname}}</p>
            </div>
        <hr>

        @foreach($answerlist as $reportinfo)
        <div white-space="pre-line">
            @foreach($reportinfo as $reportlist)
                <h4>Question:</h4>
                <p>{{ $reportlist->question }}</p>
                <h4>Answer:</h4>
                <p>{{ $reportlist->pivot->answers}}</p>             
                <hr>
            @endforeach
            
        </div>
        @endforeach
    
    </div>
    </div>
</body>
</html>
