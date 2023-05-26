<!-- Modal -->
<div class="modal fade" id="{{ $idname }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    {{-- @csrf --}}
                    {{-- <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter category"
                            aria-describedby="helpId">
                    </div> --}}
                    <x-form.input title="Name" type="text" name="{{ $username }}" id="{{ $userid }}"
                        placeholder="Enter Name" class="icon-pencil" />
                    <p class="text-sm text-danger" id="err-name"> </p>

                    <x-form.input title="Email" type="email" name="{{ $emailinput }}" id="{{ $emailid }}"
                        placeholder="Enter Email" class="fa fa-envelope" />
                    <p class="text-sm text-danger" id="err-email"> </p>
                    @if ($page == 'add page')
                        <x-form.input title="Pasword" type="password" name="{{ $passwordinput }}"
                            id="{{ $passwordid }}" placeholder="Enter Password" class="fa fa-key" />
                        <p class="text-sm text-danger" id="err-password"> </p>
                    @endif
                    <div class="form-check">
                        @foreach ($roles as $role)
                            <label class="form-check-label mr-5">
                                <input type="radio" class="form-check-input" name="{{$rolename}}" id="roles"
                                    value="{{ $role->name }}">
                                {{ $role->name }}
                            </label>
                        @endforeach
                        <p class="text-sm text-danger" id="err-role"> </p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="{{ $btnid }}">Save changes</button>
            </div>
        </div>
    </div>
</div>
