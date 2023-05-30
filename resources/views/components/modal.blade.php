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
                <form id="categoryModal">
                    {{-- @csrf --}}
                    {{-- <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Enter category" aria-describedby="helpId">
                    </div> --}}
                    <x-form.input title="Name" type="text" name="{{$nameinput1}}" id="{{$idinput1}}"
                        placeholder="Enter category" class="icon-pencil" />
                    <p class="text-sm text-danger" id="err-name"> </p>

                    <x-form.input title="Slug" type="text" name="{{$nameinput2}}" id="{{$idinput2}}"
                        placeholder="Enter Slug(Space not allowed)" class="icon-pencil"/>
                    <p class="text-sm text-danger" id="err-slug" >  </p>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="{{$btnid}}">Save changes</button>
            </div>
        </div>
    </div>
</div>
