<!-- Modal -->
<div class="modal fade" id="{{$idname}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
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
                    <x-form.input title="Name" type="text" name="{{$nameinput1}}" id="{{$idinput1}}" placeholder="Enter category"
                        class="icon-pencil" />
                    <p class="text-sm text-danger" id="err-name"> </p>

                    <x-form.input title="Email" type="email" name="{{$nameinput2}}" id="{{$idinput2}}" placeholder="Enter Slug"
                        class="icon-pencil" />
                    <p class="text-sm text-danger" id="err-slug"> </p>
                    <div class="form-check">
                        @foreach ($roles as $role)
                        <label class="form-check-label mr-5">
                            <input type="radio" class="form-check-input" name="editroles" id="roles"
                                value="{{ $role->name }}">
                            {{ $role->name}}
                        </label>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"  id="{{$btnid}}">Save changes</button>
            </div>
        </div>
    </div>
</div>
