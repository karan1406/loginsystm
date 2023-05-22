
{{-- @dd($posts) --}}
<div class="col-lg-4">
    <div class="sidebar">
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="#">
                        <input type="text" name="search" class="searchText"
                            placeholder="type to search..." autocomplete="on">
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                        <h2>Recent Posts</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach ($posts->take(3) as $post)
                                <li><a href="/postdetail/{{$post->slug}}">
                                        <h5>{{ $post->excerpt }}</h5>
                                        <span> {{ $post->updated_at->diffForHumans() }}</span>
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                        <h2>Categories</h2>
                    </div>
                    <div class="content">
                        @php
                            $categories = new App\Models\Category;;
                        @endphp
                        <ul>
                            @foreach ($categories->all() as $category)
                                <li><a href="/categorydetail/{{$category->slug}}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
