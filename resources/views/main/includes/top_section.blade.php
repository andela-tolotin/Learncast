<section class="container-fluid" id="section1">
    <div class="v-center">
        <h1 class="text-center">Learning Made Easy</h1>
        <h2 class="text-center lato animate slideInDown">Learn <b>Anytime,</b> Anywhere 24/7</h2>
        <p class="text-center">
            <br>
            @if(Auth::check())
            <a href="/dashboard" class="btn btn-primary btn-lg btn-huge lato">My Dashboard</a>
            @else
            <a href="#" class="btn btn-primary btn-lg btn-huge" data-toggle="modal" data-target="#myModal">Let start from here</a>
            @endif
        </p>
    </div>
    <a href="#section2">
        <div class="scroll-down bounceInDown animated">
            <span>
                <i class="fa fa-angle-down fa-2x"></i>
            </span>
        </div>
    </a>
</section>