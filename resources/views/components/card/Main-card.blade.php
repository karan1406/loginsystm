@props(['title'])
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title}}</h3>
            <div class="card-tools rounded-xs">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append rounded-sm ml-5">
                        @if(request()->is('category'))
                        <button type="button" class="btn btn-primary rounded-sm justify-end ml-3" data-toggle="modal" data-target="#addModal">
                            Add <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                        @elseif(request()->is('posts'))
                        <a name="addbtn" id="addbtn" class="btn btn-primary  rounded-sm justify-end ml-3" href="{{route('posts.create')}}" role="button"> Add <i class="fa fa-plus" aria-hidden="true"></i></a>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-4 container ">
            {{ $slot }}
        </div>
    </div>
</div>
