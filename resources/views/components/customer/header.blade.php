<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <h2>Stand Blog<em>.</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    @auth
                    <a class="nav-link" href="/">
                        <span >  Welcome , {{ auth()->user()->name }}!
                        </span>
                    </a>


                    <li class="nav-item">
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="border-0 btn btn-light">  Log Out</button>
                        </form>
                    </li>
                    @else


                    <li class="nav-item">
                        <a class="nav-link" href="/login">Log in</a>
                    </li>

                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
