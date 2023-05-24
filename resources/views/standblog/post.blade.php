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
                                        <a href="/postdetail/{{ $post->slug }}">
                                            <h4>{{ $post->excerpt }}</h4>
                                        </a>
                                        <ul class="post-info text-dark">
                                            <li><a
                                                    href="/author/{{ $post->user->id }}">{{ ucfirst($post->user->name) }}</a>
                                            </li>
                                            <li> {{ $post->updated_at->format('M d, Y') }}</li>
                                            {{-- <li class="text-dark"><a href="#" class="text-dark">12 Comments</a>
                                            </li> --}}
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
                                                        <button class="btn btn-success" id="like">
                                                            <i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>
                                                            {{ count($post->likes->where('status', 1)) }}
                                                        </button>
                                                        <button class="btn btn-danger" id="dislike">
                                                            <i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i>
                                                            {{ count($post->likes->where('status', 0)) }}
                                                        </button>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @auth
                        <form method="post" action="{{ route('comments.store') }}"
                            class="flex border border-gray-200 p-6 rounded-xl">
                            @csrf
                            <div class="row mt-3">
                                <div class="col-1 ml-4">
                                    <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" width="60" height="60"
                                        class="rounded-circle mt-2">
                                </div>
                                <div class="col-6 mt-4 ml-3">
                                    <h5> Want To Participate? </h5>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-group">
                                    <textarea class="form-control w-75 ml-5" name="body" id="body" rows="5"
                                        placeholder="Quick, thing of somthing to say!" required></textarea>
                                </div>
                                @error('body')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex mb-2 ml-6">
                                <span style="margin-left: 75%">
                                    <button type="submit" class="btn" style="background-color:#f48840" id="commentadd"
                                        name="post_id" value="{{ $post->id }}"> POST</button>
                                </span>
                            </div>
                        </form>
                    @else
                        <div class="col-lg-12 border  p-5">
                            <a href="/register" style="color:#f48840"> Register </a> Or <a href="/login"
                                style="color:#f48840"> Login </a>
                            to leave a comment.
                        </div>
                    @endauth
                    <x-comment :posts="$post->comments->reverse()" />
                </div>

                <x-customer.sidebar :posts="$posts" />

            </div>
    </section>


    <x-customer.footer />

</x-customer.layout2>


<script>
    $(document).on('click', '#like', function() {
        var id = {{ $post->id }};
        var url = " {{ route('likes.store') }}";

        $.ajax({
            type: 'post',
            url: url,
            data: {
                _token: " {{ csrf_token() }}",
                id: id,
                status: 1
            },
            success: function(responce) {
                console.log(responce);
                window.location.reload();
            },
            error: function(dataResult) {
                if (dataResult.status == 401) {
                    window.location.href = '/login';
                }
            }

        });
    });
    $(document).on('click', '#dislike', function() {
        var id = {{$post->id}};
        var url = " {{ route('likes.store') }}";

        $.ajax({
            type: 'post',
            url: url,
            data: {
                _token: " {{ csrf_token() }}",
                id: id,
                status: 0
            },
            success: function(responce) {
                console.log(responce);
                window.location.reload();
            },
            error: function(dataResult) {
                if (dataResult.status == 401) {
                    window.location.href = '/login';
                }
            }

        });
    });
</script>

@if (session()->get('comment'))
    <script>
        toastr["success"]("{{ session('comment') }}");
    </script>
@endif
