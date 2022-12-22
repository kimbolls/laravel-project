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

    </head>
    <!--header-->
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
                        @if(Auth::user()->usertype=="FYP Coordinator") <li><a href="/add" class="external">Add Students</a></li> @endif
                    </ul>
                </li>
                <li class="has-submenu"><a href="">Projects</a>
                    <ul class="sub-menu">
                        <li><a href="/displayprojects" class="external">View Projects</a></li>
                        @if(Auth::user()->usertype=="FYP Coordinator")<li><a href="/create" class="external">Add Projects</a></li> @endif
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


    <section class="section courses min-vh-100" data-section="section4">
        <div class="row " align="center">
            <div class="col-md-12">
                <div class="section-heading ">
                    <h2>Add new Students </h2>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <form action="/adddata" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-auto">
                            <label for="studentid" class="text-light"> Student ID </label>
                            <input type="text" class="form-control" required name="studentid" id="studentid" placeholder="Student ID ">

                        </div>


                        <div class="form-group col-auto">
                            <label for="username" class="text-light"> Student Name </label>
                            <input type="text" class="form-control" required name="username" placeholder="Student Name ">

                        </div>
                    </div>
                    <input type=reset class="btn btn-secondary mb-2" value="Reset">
                    <input type=submit class="btn btn-primary mb-2" value="Add Record">
                </form>

            </div>
        </div>
    </section>


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