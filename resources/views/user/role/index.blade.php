<x-layout>
    <header>
        <x-navbar />
    </header>
    <aside>
        <x-sidebar />
    </aside>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .container1 {
            max-width: 1000px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .switch-holder {
            display: flex;
            padding: 10px 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: -8px -8px 15px rgba(255, 255, 255, .7),
                10px 10px 10px rgba(0, 0, 0, .3),
                inset 8px 8px 15px rgba(255, 255, 255, .7),
                inset 10px 10px 10px rgba(0, 0, 0, .3);
            justify-content: space-between;
            align-items: center;
        }

        .switch-label {
            width: 150px;
        }

        .switch-label i {
            margin-right: 5px;
        }

        .switch-toggle {
            height: 40px;
        }

        .switch-toggle input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            z-index: -2;
        }

        .switch-toggle input[type="checkbox"]+label {
            position: relative;
            display: inline-block;
            width: 100px;
            height: 40px;
            border-radius: 20px;
            margin: 0;
            cursor: pointer;
            box-shadow: inset -8px -8px 15px rgba(255, 255, 255, .6),
                inset 10px 10px 10px rgba(0, 0, 0, .25);

        }

        .switch-toggle input[type="checkbox"]+label::before {
            position: absolute;
            content: 'OFF';
            font-size: 13px;
            text-align: center;
            line-height: 25px;
            top: 8px;
            left: 8px;
            width: 45px;
            height: 25px;
            border-radius: 20px;
            background-color: #d1dad3;
            box-shadow: -3px -3px 5px rgba(255, 255, 255, .5),
                3px 3px 5px rgba(0, 0, 0, .25);
            transition: .3s ease-in-out;
        }

        .switch-toggle input[type="checkbox"]:checked+label::before {
            left: 50%;
            content: 'ON';
            color: #fff;
            background-color: #00b33c;
            box-shadow: -3px -3px 5px rgba(255, 255, 255, .5),
                3px 3px 5px #00b33c;
        }

    </style>



    <section class="content-wrapper">
        <x-card.Main-card title="Manage Roles and Permission">
            <div class="container">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created at</th>
                            <th class="text-center"> Permission <br>
                                <span style="padding-right:100px"> Write </span> <span style="padding-left:50px"> Edit
                                </span> <span style="padding-left:120px"> Publish </span>
                            </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($roles as $role)
                        @if ($role->name == 'admin')
                        @continue
                        @endif
                        <tr>
                            <td id="namevalue"> {{ $role->name }} </td>
                            <td id="create"> {{ $role->created_at->format('Y m,d') }} </td>
                            <td>
                                <div class="container1">
                                    <div class="switch-toggle">
                                        <input type="checkbox" id="write-{{ $role->id }}" name="changepermission" class="write" {{ $role->hasPermissionTo('write post') ? 'checked' : ' ' }} onchange="editpermission('write-{{ $role->id }}')">
                                        <label for="write-{{ $role->id }}"></label>
                                    </div>
                                    <div class="switch-toggle">
                                        <input type="checkbox" id="edit-{{ $role->id }}" name="changepermission" class="edit" {{ $role->hasPermissionTo('edit post') ? 'checked' : ' ' }} onchange="editpermission('edit-{{ $role->id }}')">
                                        <label for="edit-{{ $role->id }}"></label>
                                    </div>
                                    <div class="switch-toggle">
                                        <input type="checkbox" id="publish-{{ $role->id }}" name="changepermission" class="publish" {{ $role->hasPermissionTo('publish post')
                                                    ? 'checked'
                                                    : '
                                                                                        ' }} onchange="editpermission('publish-{{ $role->id }}')">
                                        <label for="publish-{{ $role->id }}"></label>
                                    </div>
                            </td>
                            @if($role->name == 'visitor')
                            <td> <img src="/images/trash.jpg" height="50" width="50">  </td>
                            @else
                            <td>
                                <button type="button" class="btn btn-danger" id="dltbtn" value="{{ $role->id }}"><i class="icon-trash" style="font-size: 20px"></i></button>
                            </td>
                            @endif

                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
        </x-card.Main-card>

        <x-add-role title="Add role" name="name" id="name" btnid="adddata" idname="addRoleModal" :role='$role' />
    </section>


    <x-footer />

</x-layout>
<script>
    $(document).ready(function() {
        $("#datatable").DataTable();

        $("#adddata").click(function(e) {
            e.preventDefault();
            var name = $('#name').val();

            const permissions = [];

            $("#permissionsOfRole input:checkbox:checked").map(function() {
                permissions.push($(this).val());
            });

            console.log(permissions);
            console.log(name);

            $.ajax({
                type: "POST"
                , url: "{{ route('roles.store') }}"
                , data: {
                    '_token': '{{ csrf_token() }}'
                    , 'type': 1
                    , 'name': name
                    , 'permission': permissions
                },
                // cache = false,
                success: function(response) {
                    console.log("callback function");
                    window.location.reload();
                }
                , error: function(dataResult) {
                    console.log(dataResult);
                    $error = dataResult.responseJSON.errors;
                    if (dataResult.status == 422) {
                        $.each($error, function(key, value) {
                            $('#err-' + key).html(value);
                        });
                    }
                }

            });
        });

        $(document).on('click', '#dltbtn', function() {
            var id = $(this).val();
            console.log(id);
            var url = "{{ route('roles.destroy', ':id') }}";
            url = url.replace(':id', id);
            console.log(url);
            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE"
                        , url: url
                        , data: {
                            '_token': '{{ csrf_token() }}'
                        , },
                        // cache = false,
                        success: function(response) {
                            console.log("callback function");
                            // window.location.reload();
                        }
                        , error: function(dataResult) {
                            console.log(dataResult);
                        }

                    });

                }
            })
        });



        // edit data
        $("#editdata").click(function(e) {
            e.preventDefault();
            var name = $('#editname').val();
            var status = $('input[type="radio"][name="editroles"]:checked').val();
            var email = $('#editemail').val();
            var id = $(this).val();
            var url = "{{ route('users.update', ':id') }}";
            url = url.replace(':id', id);
            console.log(name);
            console.log(status);
            console.log(email);
            console.log(url);
            console.log(id);

            $.ajax({
                type: "PATCH"
                , url: url
                , data: {
                    '_token': '{{ csrf_token() }}'
                    , 'type': 1
                    , 'name': name
                    , 'status': status
                    , 'email': email
                },
                // cache = false,
                success: function(response) {
                    console.log("callback function");
                    window.location.reload();
                }
                , error: function(dataResult) {
                    console.log(dataResult);
                    $error = dataResult.responseJSON.errors;
                    if (dataResult.status == 422) {
                        $.each($error, function(key, value) {
                            $('#err-' + key).html(value);
                        });
                    }
                }

            });
        });


    });

</script>

<script>
    function editpermission(editstate) {
        // alert(editstate);
        var id = editstate.split('-')[1];
        var permission = editstate.split('-')[0] + ' ' + 'post';
        console.log(permission);
        var status = $('#' + editstate).is(':checked') ? 'on' : 'off';
        var url = "/updatePermission/" + id;
        // alert(url);
        $.ajax({
            type: "post"
            , url: url
            , data: {
                '_token': '{{ csrf_token() }}'
                , 'state': status
                , 'permission': permission
            , }
            , success: function(response) {
                console.log("callback function");
                window.location.reload();
            }
            , error: function(dataResult) {
                console.log(dataResult);
            }
        });
    }

</script>
@if (session()->get('successpermission'))
<script>
    toastr.success('Done', "{{ session()->get('successpermission') }}");
</script>
@endif
