@props(['title'])
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools rounded-xs">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append rounded-sm ml-5">
                        @if (request()->is('category'))
                            @role('admin')
                                <button type="button" class="btn btn-primary rounded-sm justify-end ml-3" data-toggle="modal"
                                    data-target="#addModal">
                                    Add <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            @endrole
                        @elseif(request()->is('posts'))
                            @can('write post')
                                <a name="addbtn" id="addbtn" class="btn btn-primary  rounded-sm justify-end ml-3"
                                    href="{{ route('posts.create') }}" role="button"> Add <i class="fa fa-plus"
                                        aria-hidden="true"></i></a>
                            @endcan
                        @elseif(request()->is('roles'))
                            <a name="addbtn" id="addbtn" class="btn btn-primary  rounded-sm justify-end ml-3"
                                 role="button" data-toggle="modal"
                                 data-target="#addRoleModal"> Add <i class="fa fa-plus"
                                    aria-hidden="true"></i></a>
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
