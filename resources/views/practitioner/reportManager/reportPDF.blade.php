<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 20px 40px; }        
    </style>
</head>

<body>
    <div id="page-wrapper">
    <div class="container-fluid">
        <h2> A T E S T</h2>
        <h3>Report: {{$report->id}}</h3>
        <input type="hidden" name="reportid" value={{$report->id}}>
            <div>
                <p style="text-align:right"> Client's name: {{ $clientinfo->fname}} {{ $clientinfo->sname}} </p>
                <p style="text-align:right"> Practitioner's name: {{ $pracinfo->fname }} {{ $pracinfo->sname}}</p>
            </div>
        <hr>

        @foreach($answerlist as $reportinfo)
        <div white-space="pre-line">
            @foreach($reportinfo as $reportlist)
                <h4>QUESTION:</h4>
                <p>{{ $reportlist->question }}</p>
                <h4>ANSWER:</h4>
                <p>{{ $reportlist->pivot->answers}}</p>             
                <hr>
            @endforeach
            
        </div>
        @endforeach
    
    </div>
    </div>
</body>
</html>
