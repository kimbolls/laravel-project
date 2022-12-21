<html>

<body>
    <h1> Update Project Details </h1>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            $("select").each(function(cSelect) {
                $(this).data('stored-value', $(this).val());
            });

            $("select").change(function() {
                var cSelected = $(this).val();
                var cPrevious = $(this).data('stored-value');
                $(this).data('stored-value', cSelected);

                var otherSelects = $("select").not(this);

                otherSelects.find('option[value=' + cPrevious + ']').removeAttr('disabled');
                otherSelects.find('option[value=' + cSelected + ']').attr('disabled', 'disabled');
            });
        });
    </script>
    <script>
        const setup = () => {
            let firstDate = $('#startdate').val();
            let secondDate = $('#enddate').val();
            const findTheDifferenceBetweenTwoDates = (firstDate, secondDate) => {
                firstDate = new Date(firstDate);
                secondDate = new Date(secondDate);
                let timeDifference = Math.abs(secondDate.getTime() - firstDate.getTime());
                let millisecondsInADay = (1000 * 3600 * 24);
                let differenceOfDays = Math.ceil(timeDifference / millisecondsInADay);
                return differenceOfDays;
            }
            let result = findTheDifferenceBetweenTwoDates(firstDate, secondDate);
            result = Math.floor(result / 30)
            $("#duration").val(result);
        }

        $(document).ready(function() {
            $('#startdate').change(function() {
                if ($('#enddate').val() != '') {
                    setup();
                }
            })
            $('#enddate').change(function() {
                if ($('#startdate').val() != '') {
                    setup();
                }
            })
        });
    </script>

    <form action={{"/update/".$selected['projectid']}} method="post">
        @csrf
        <!-- student name -->
        Student Name :

        @foreach($student as $datastudent)
        <input type="hidden" name="studentid" value={{$selected["studentid"]}}>
        <input type="hidden" name="projectid" value={{$selected["projectid"]}}>
        @if($selected["studentid"] == $datastudent["studentid"])

        <input type="name" name="studentname" value={{$datastudent["username"]}} disabled> <br><br>
        @endif
        @endforeach
        <!-- title -->
        Project Title : <input type="name" name="projecttitle" value={{$selected->projecttitle}}> <br><br>

        <!-- category -->
        Project Category : <select name="category" id="category">
            <option value="Research Project">Research Project</option>
            <option value="Development Project">Development Project </option>
        </select> <br><br>

        <!-- sv name -->
        Superviser Name : <select name="superviserid" id="superviserid">
            @foreach($teacher as $datateacher)
            @if ($datateacher['usertype']=='Superviser')
            <option value="{{$datateacher["userid"]}}" @if($selected->superviserid == $datateacher->userid) selected @endif> {{$datateacher["name"]}} </option>
            @endif
            @endforeach
        </select> <br><br>
        <!-- ex 1 name -->
        Examiner 1 Name : <select name="examinerid1" id="examinerid1">
            @foreach($teacher as $datateacher)
            @if ($datateacher['usertype']=='Superviser')
            <option value="{{$datateacher["userid"]}}" @if($selected->examinerid1 == $datateacher->userid) selected @endif> {{$datateacher["name"]}} </option>
            @endif
            @endforeach
        </select> <br><br>

        <!-- ex 2 name -->
        Examiner 2 Name : <select name="examinerid2" id="examinerid2">
            @foreach($teacher as $datateacher)
            @if ($datateacher['usertype']=='Superviser')
            <option value="{{$datateacher["userid"]}}" @if($selected->examinerid2 == $datateacher->userid) selected @endif> {{$datateacher["name"]}} </option>
            @endif
            @endforeach
        </select> <br><br>

        Start Date : <input type="date" name="startdate" id="startdate" value={{$selected->startdate}}> <br><br>
        End Date : <input type="date" name="enddate" id="enddate" value={{$selected->enddate}}> <br><br>
        Progress : <select name="progress" id="progress">
            <option value="Milestone 1" @if($selected->progress == "Milestone 1") selected @endif> Milestone 1</option>
            <option value="Milestone 2" @if($selected->progress == "Milestone 2") selected @endif> Milestone 2</option>
            <option value="Final Report" @if($selected->progress == "Final Report") selected @endif> Final Report</option>
        </select> <br><br>
        Status : <select name="status" id="status">
            <option value="On Track" @if($selected->status == "On track") selected @endif> On Track</option>
            <option value="Delayed" @if($selected->status == "Delayed") selected @endif> Delayed</option>
            <option value="Extended" @if($selected->status == "Extended") selected @endif> Extended</option>
            <option value="Completed" @if($selected->status == "Completed") selected @endif> Completed</option>
        </select> <br><br>
        Duration (in months): <input type="number" name="duration" id="duration" readonly value={{$selected->duration}}> <br><br>
        <input type=submit value="Update Project">
        <input type=reset value="Reset">


    </form>


</body>

</html>