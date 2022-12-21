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
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="assets/css/fontawesome.css">
        <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
        <link rel="stylesheet" href="assets/css/owl.css">
        <link rel="stylesheet" href="assets/css/lightbox.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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

    <!-- banner -->
    <!-- content here -->
    <section class="section courses min-vh-100" data-section="section4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="section-heading ">
                    <h2>All Final Year Projects</h2>
                </div>
            </div>
            <div class="col-md-11 ">
                <table class="table table-bordered table-hover table-dark table-striped center">
                    <thead class="thead-light">
                        <tr>
                            <th>Project Title</th>
                            <th>Student Name</th>
                            <th>Project Category</th>
                            <th>Superviser Name </th>
                            <th>Examiner 1 Name</th>
                            <th>Examiner 2 Name</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Duration (in months) </th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                    </thead>
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

                <!-- Content Division -->

                <!-- Table -->

                <!-- table end -->
            </div>
        </div>
    </section>
    <!-- Div end -->



    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fa fa-copyright"></i> Made by Hakim

                        | <a href="https://templatemo.com" rel="sponsored" target="_parent">SW01080783</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer end -->
    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
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