<x-customer.layout2>
    <!-- ***** Presloader ***** -->
    <x-customer.preloader />
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <x-customer.header />
    <!-- Header End -->
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <x-customer.slider :posts="$posts" />
    <!-- Banner Ends Here -->

    <section class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @foreach ($posts as $post)
                               <x-customer.post-grid :post="$post" />
                            @endforeach
                            @if(count($posts) != 0)
                            <div class="col-lg-12">
                                <div class="main-button">
                                    <a href="/post/blog">View All Posts</a>
                                </div>
                            </div>
                            @else
                            <div class="text-sm">
                                <h1> No Post Are There</h1>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            <x-customer.sidebar :posts='$posts'  />
            </div>
        </div>
    </section>

    <x-customer.footer />

</x-customer.layout2>
