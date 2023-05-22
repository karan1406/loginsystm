<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            @foreach ($posts->take(3) as $post)
                <div class="item">
                    <img src="{{ $post->image }}" width="350" height="350" alt="">
                    <div class="item-content">
                        <div class="main-content">
                            <div class="meta-category">
                            <a href="/categorydetail/{{$post->category->slug}}">
                                <span> {{ ucfirst($post->category->name) }}</span>
                            </a>
                            </div>
                            <a href="/postdetail/{{$post->slug}}">
                                <h4 class="text-dark">{{ $post->name }}</h4>
                            </a>
                            <ul class="post-info text-dark">
                                <li ><a href="/author/{{$post->user->id}}">{{ ucfirst($post->user->name)}}</a></li>
                                <li> {{ $post->updated_at->format("M d, Y") }}</li>
                                {{-- <li class="text-dark"><a href="#" class="text-dark">12 Comments</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
