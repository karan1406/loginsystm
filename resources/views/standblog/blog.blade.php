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

    {{-- @dd($posts) --}}

   <x-customer.header-text title="{{ Str::contains(url()->current(),'post') ? 'Post' : (Str::contains(url()->current(),'author' )  ? $posts[0]->user->name : $posts[0]->category->name)}}" />


    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @foreach ($posts->where('status','1') as $post)
                            <div class="col-lg-6">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="{{ $post->image }}" height="300" width="300" alt="">
                                    </div>
                                    <div class="down-content">
                                        <span>{{ $post->category->name}}</span>
                                        <a href="/postdetail/{{ $post->slug }}">
                                            <h4>{{ $post->name }}</h4>
                                        </a>
                                        <ul class="post-info text-dark">
                                            <li ><a href="/author/{{$post->user->id}}">{{ ucfirst($post->user->name)}}</a></li>
                                            <li> {{ $post->updated_at->format("M d, Y") }}</li>
                                            {{-- <li class="text-dark"><a href="#" class="text-dark">12 Comments</a></li> --}}
                                        </ul>
                                        <p> {{ $post->excerpt }}</p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="post-tags">
                                                        {{-- <li><i class="fa fa-tags"></i></li> --}}
                                                        <li><a href="/postdetail/{{$post->slug}}">{{ $post->name }}</a>,</li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="post-share">
                                                        <li><i class='fa fa-comment' style='font-size:20px;color:#f48840'></i> {{ count($post->comments)}}</li>
                                                        <li><i class="fa fa-heart" style="font-size:20px;color:#f48840"></i>   {{ count($post->likes->where('status', 1)) }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <x-customer.sidebar :posts="$posts" />

            </div>
        </div>
    </section>

    <div class="container">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
    <x-customer.footer />

</x-customer.layout2>
