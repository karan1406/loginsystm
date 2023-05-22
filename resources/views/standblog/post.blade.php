<x-customer.layout2>
    <!-- ***** Presloader ***** -->
    <x-customer.preloader />
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <x-customer.header />
    <!-- Header End -->
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    {{--
    <x-customer.slider :posts="$posts" /> --}}
    <!-- Banner Ends Here -->
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Post Details</h4>
                            <h2>Single blog post</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="{{ $post->image }}" alt="">
                                    </div>
                                    <div class="down-content">
                                        <span>{{ $post->category->name }}</span>
                                        <a href="/postdetail/{{$post->slug}}">
                                            <h4>{{ $post->excerpt }}</h4>
                                        </a>
                                        <ul class="post-info text-dark">
                                            <li ><a href="/author/{{$post->user->id}}">{{ ucfirst($post->user->name)}}</a></li>
                                            <li> {{ $post->updated_at->format("M d, Y") }}</li>
                                            {{-- <li class="text-dark"><a href="#" class="text-dark">12 Comments</a></li> --}}
                                        </ul>
                                        <p>{!! $post->body !!}
                                        </p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-6">


                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i></li>
                                                        <li><a
                                                                href="/postdetail/{{ $post->slug }}">{{ $post->name }}</a>,
                                                        </li>

                                                    </ul>

                                                </div>
                                                <div class="col-6">
                                                    <ul class="post-share">
                                                        <li><i class="fa fa-share-alt"></i></li>
                                                        <li><a href="#">Facebook</a>,</li>
                                                        <li><a href="#"> Twitter</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <x-customer.sidebar :posts="$posts" />

            </div>
    </section>


    <x-customer.footer />

</x-customer.layout2>