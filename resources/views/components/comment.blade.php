{{-- @dd($posts) --}}

<div class="col-lg-12">
    <div class="sidebar-item comments">
        <div class="sidebar-heading">
            <h2> {{$posts->count()}} comments</h2>
        </div>
        @php
              $i = 1    ;
        @endphp
        @foreach ($posts as $comment)
          @foreach ($comment->users as $user)

            <div class="content">
                <ul>
                    <li class="{{$i % 2 == 0 ? 'replied mt-4' : 'mt-4'}}">
                        <div class="author-thumb">
                            <img src="https://i.pravatar.cc/150?u={{ $user->id }}" class="rounded-circle" alt="">
                        </div>
                        <div class="right-content mt-4">
                            <span>
                                <h4> {{ ucfirst($user->name) }}
                            </span>
                            @endforeach
                            <span>{{ $comment->created_at->format('M d,Y') }}</span></h4>
                            <p> {{ $comment->body }}</p>
                        </div>
                    </li>

                </ul>
            </div>
            @php
                $i++
            @endphp
        @endforeach

    </div>
</div>
