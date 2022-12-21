<h1> Projects List </h1>

<table border="border">
    <tr>
        <td>Project Title</td>
        <td>Student Name</td>
        <td>Project Category</td>
        <td>Superviser Name </td>
        <td>Examiner 1 Name</td>
        <td>Examiner 2 Name</td>
        <td>Progress</td>
        <td>Status</td>
        <td>Duration (in months) </td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Delete</td>
        <td>Update</td>
    </tr>
    @foreach($project as $dataproject)
    <tr>
        <td>{{$dataproject["projecttitle"]}}</td>
        @foreach($student as $datastudent)
        @if($dataproject["studentid"] == $datastudent["studentid"])
        <td> {{$datastudent["username"]}}</td>
        @endif
        @endforeach

        <td>{{$dataproject["category"]}}</td>
        @foreach($teacher as $datateacher)
        @if($dataproject["superviserid"] == $datateacher["userid"])
        <td> {{$datateacher["name"]}}</td>
        @endif
        @endforeach
        @foreach($teacher as $datateacher)
        @if($dataproject["examinerid1"] == $datateacher["userid"])
        <td> {{$datateacher["name"]}}</td>
        @endif
        @endforeach
        @foreach($teacher as $datateacher)
        @if($dataproject["examinerid2"] == $datateacher["userid"])
        <td> {{$datateacher["name"]}}</td>
        @endif
        @endforeach
        <td>{{$dataproject->progress ?? "Not yet Set"}}</td>
        <td>{{$dataproject->status ?? "Not yet Set"}}</td>
        <td>{{$dataproject->duration ?? "Not yet Set"}}</td>
        <td> {{$dataproject->startdate ?? "Not yet Set"}}</td>
        <td>{{$dataproject->enddate ?? "Not yet Set"}}</td>
        <td><a href={{"/deleteproject/".$dataproject["projectid"]}}>Delete</a></td>
        <td><a href={{"/updateproject/".$dataproject["projectid"]}}>Update</a></td>
    </tr>
    @endforeach
</table>