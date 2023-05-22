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
                    <x-form.input title="Name" type="text" name="{{$name}}" id="{{$id}}" placeholder="Enter Role Name"
                        class="icon-pencil" />
                    <p class="text-sm text-danger" id="err-{{$name}}"> </p>
                    <label> Add Permission </label>
                    <div>
                    <span style="padding-left:60px"> Write </span> <span style="padding-left:110px"> Edit
                    </span> <span style="padding-left:120px"> Publish </span>
                    </div>
                    <div class="container1" id="permissionsOfRole">
                        <div class="switch-toggle">
                            <input type="checkbox" id="write" name="permission" value="write post" class="write"  >
                            <label for="write"></label>
                        </div>
                        <div class="switch-toggle">
                            <input type="checkbox" id="edit" name="permission" value="edit post" class="edit" >
                            <label for="edit"></label>
                        </div>
                        <div class="switch-toggle">
                            <input type="checkbox" id="publish" name="permission" value="publish post" class="publish">
                            <label for="publish"></label>
                        </div>
                    <p class="text-sm text-danger" id="err-permission"> </p>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="{{$btnid}}">Save changes</button>
            </div>
        </div>
    </div>
</div>
