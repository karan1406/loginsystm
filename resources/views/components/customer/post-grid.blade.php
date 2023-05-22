
    <div class="col-lg-12">
        <div class="blog-post">
            <div class="blog-thumb">
                <img src="{{ $post->image }}" alt="">
            </div>
            <div class="down-content">
                <a href="/categorydetail/{{$post->category->slug}}">
                    <span> {{ ucfirst($post->category->name) }}</span>
                </a>
                <a href="/postdetail/{{$post->slug}}">
                    <h4>{{ $post->name }}</h4>
                </a>
                <ul class="post-info text-dark">
                    <li ><a href="/author/{{$post->user->id}}">{{ ucfirst($post->user->name)}}</a></li>
                    <li> {{ $post->updated_at->format("M d, Y") }}</li>
                    {{-- <li class="text-dark"><a href="#" class="text-dark">12 Comments</a></li> --}}
                </ul>
                <p> {!! $post->excerpt !!}</p>
                <div class="post-options">
                    <div class="row">
                        <div class="col-6">
                            <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                <li><a href="/postdetail/{{$post->slug}}">{{ $post->name }}</a>,</li>

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

