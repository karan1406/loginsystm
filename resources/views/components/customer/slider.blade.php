<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            @foreach ($posts->take(3) as $post)
            <div class="item">
                <img src="{{ $post->image }}" width="350" height="350" alt="">
            </div>
            @endforeach
        </div>
    </div>
</div>

