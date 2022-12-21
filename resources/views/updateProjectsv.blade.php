<html>

<body>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <title>FYP Manager</title>

        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">



        <!-- Additional CSS Files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../assets/css/fontawesome.css">
        <link rel="stylesheet" href="../assets/css/templatemo-grad-school.css">
        <link rel="stylesheet" href="../assets/css/owl.css">
        <link rel="stylesheet" href="../assets/css/lightbox.css">
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

    </head>
    <header class="main-header clearfix" role="header">
        <div class="logo">
            <a href="#"><em>FYP</em> Manager</a>
        </div>
        <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
        <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
                <li><a href="/home" class="external">Home</a></li>
                <li class="has-submenu"><a href="">Students</a>
                    <ul class="sub-menu">
                        <li><a href="/displaystudents" class="external">View Students</a></li>
                        <li><a href="/add" class="external">Add Students</a></li>
                    </ul>
                </li>
                <li class="has-submenu"><a href="">Projects</a>
                    <ul class="sub-menu">
                        <li><a href="/displayprojects" class="external">View Projects</a></li>
                        <li><a href="/create" class="external">Add Projects</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
    </header>




    <!-- content here -->
    <section class="section courses min-vh-100" data-section="section4">
        <div class="row " align="center">
            <div class="col-md-12">
                <div class="section-heading ">
                    <h2>Update Project Details </h2>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <form action={{"/update/".$selected['projectid']}} method="post">
                    @csrf
                    <!-- student name -->
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="studentname" class="text-light"> Student Name </label>
                            @foreach($student as $datastudent)
                            <input type="hidden" name="studentid" value={{$selected["studentid"]}}>
                            <input type="hidden" name="projectid" value={{$selected["projectid"]}}>
                            @if($selected["studentid"] == $datastudent["studentid"])
                            <input type="name" class="form-control" name="studentname" class="form-control" required value={{$datastudent["username"]}} disabled>
                        </div>
                        @endif
                        @endforeach
                        <!-- title -->
                        <div class="form-group col">
                            <label for="projectittle" class="text-light"> Project Title </label>
                            <input type="name" class="form-control" readonly name="projecttitle" value={{$selected->projecttitle}}>
                        </div>
                    </div>

                    <!-- category -->
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="category" class="text-light"> Category </label>
                            <select name="category" class="form-control" disabled id="category">
                                <option value="Research Project">Research Project</option>
                                <option value="Development Project">Development Project </option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="superviserid" class="text-light"> Superviser ID </label>
                            <select name="superviserid" class="form-control" disabled id="superviserid">
                                @foreach($teacher as $datateacher)
                                @if ($datateacher['usertype']=='Superviser')
                                <option value="{{$datateacher["userid"]}}" @if($selected->superviserid == $datateacher->userid) selected @endif> {{$datateacher["name"]}} </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="examinerid1" class="text-light"> Examiner 1 Name : </label>
                            <select name="examinerid1" class="form-control" disabled id="examinerid1">
                                @foreach($teacher as $datateacher)
                                @if ($datateacher['usertype']=='Superviser')
                                <option value="{{$datateacher["userid"]}}" @if($selected->examinerid1 == $datateacher->userid) selected @endif> {{$datateacher["name"]}} </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="examinerid2" class="text-light"> Examiner 2 Name : </label>
                            <select name="examinerid2" class="form-control" disabled id="examinerid2">
                                @foreach($teacher as $datateacher)
                                @if ($datateacher['usertype']=='Superviser')
                                <option value="{{$datateacher["userid"]}}" @if($selected->examinerid2 == $datateacher->userid) selected @endif> {{$datateacher["name"]}} </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col">
                            <label for="startdate" class="text-light"> Start Date : </label>
                            <input type="date" class="form-control "  required name="startdate" id="startdate" value={{$selected->startdate}}>
                        </div>
                        <div class="form-group col">
                            <label for="startdate" class="text-light"> End Date : </label>
                            <input type="date" class="form-control "   required name="enddate" id="enddate" value={{$selected->enddate}}>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="progress" class="text-light"> Progress : </label>
                            <select name="progress" class="form-control "  required id="progress">
                            <option value="" @if($selected->progress == "") selected @endif> Not Yet Set </option>
                                <option value="Milestone 1" @if($selected->progress == "Milestone 1") selected @endif> Milestone 1</option>
                                <option value="Milestone 2" @if($selected->progress == "Milestone 2") selected @endif> Milestone 2</option>
                                <option value="Final Report" @if($selected->progress == "Final Report") selected @endif> Final Report</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="status" class="text-light"> Status : </label>
                            <select name="status" class="form-control "  required id="status">
                                <option value="" @if($selected->status == "") selected @endif> Not Yet Set </option>
                                <option value="On Track" @if($selected->status == "On track") selected @endif> On Track</option>
                                <option value="Delayed" @if($selected->status == "Delayed") selected @endif> Delayed</option>
                                <option value="Extended" @if($selected->status == "Extended") selected @endif> Extended</option>
                                <option value="Completed" @if($selected->status == "Completed") selected @endif> Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="duration" class="text-light">Duration (in months):</label>
                            <input type="number" class="form-control " name="duration" id="duration" readonly value={{$selected->duration}}> <br><br>
                        </div>
                    </div>
                    <input type=reset class="btn btn-secondary mb-2" value="Reset">
                    <input type=submit class="btn btn-primary mb-2"value="Update Project">
                    


                </form>


                <!-- Content Division -->

                <!-- Table -->

                <!-- table end -->
            </div>
        </div>
    </section>
    <!-- Div end -->


    <!-- banner -->



    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fa fa-copyright"></i> Made by Hakim

                        | <a href="" rel="sponsored" target="_parent">SW01080783</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer end -->
    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/isotope.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/lightbox.js"></script>
    <script src="../assets/js/tabs.js"></script>
    <script src="../assets/js/video.js"></script>
    <script src="../assets/js/slick-slider.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
            var
                direction = section.replace(/#/, ''),
                reqSection = $('.section').filter('[data-section="' + direction + '"]'),
                reqSectionPos = reqSection.offset().top - 0;

            if (isAnimate) {
                $('body, html').animate({
                        scrollTop: reqSectionPos
                    },
                    800);
            } else {
                $('body, html').scrollTop(reqSectionPos);
            }

        };

        var checkSection = function checkSection() {
            $('.section').each(function() {
                var
                    $this = $(this),
                    topEdge = $this.offset().top - 80,
                    bottomEdge = topEdge + $this.height(),
                    wScroll = $(window).scrollTop();
                if (topEdge < wScroll && bottomEdge > wScroll) {
                    var
                        currentId = $this.data('section'),
                        reqLink = $('a').filter('[href*=\\#' + currentId + ']');
                    reqLink.closest('li').addClass('active').
                    siblings().removeClass('active');
                }
            });
        };

        $('.main-menu, .scroll-to-section').on('click', 'a', function(e) {
            if ($(e.target).hasClass('external')) {
                return;
            }
            e.preventDefault();
            $('#menu').removeClass('active');
            showSection($(this).attr('href'), true);
        });

        $(window).scroll(function() {
            checkSection();
        });
    </script>
</body>

</html>