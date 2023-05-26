<x-layout>
    <header>
        <x-navbar />
    </header>
    <aside>
        <x-sidebar />
    </aside>
    {{-- @dd($users) --}}

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
        <x-card.Main-card title="Manage Post">
            <div class="container">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>

                            @canany(['user edit', 'user delete'])
                                <th cols="2"> Action </th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            @foreach ($user->roles as $role)
                                @if ($role->name == "Super Admin")
                                    @continue
                                @endif
                            <tr>
                                <td id="namevalue"> {{ $user->name }} </td>
                                <td id="emailid"> {{ $user->email }} </td>
                                <td id="role">
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </td>

                                @canany(['user edit', 'user delete'])
                                    <td>
                                        @can('user edit')
                                            <button type="button" class="btn btn-primary" id="editbtn"
                                                data-id="{{ $user->id }}"> <i class="icon-edit"
                                                    style="font-size: 20px"></i></button>
                                        @endcan
                                        @can('user delete')
                                            <button type="button" class="btn btn-danger" id="dltbtn"
                                                value="{{ $user->id }}"><i class="icon-trash"
                                                    style="font-size: 20px"></i></button>
                                        @endcan
                                    </td>
                                @endcanany

                            </tr>
                            @endforeach

                        @endforeach


                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
        </x-card.Main-card>

        <x-user-modal idname="addModal" title="Add User" btnid="adddata" username="addname" userid="addname"
            emailinput="addemail" emailid="addemail" passwordinput="password"  rolename="addroles" passwordid="password" page="add page"
            :roles="$roles" />


        <x-user-modal idname="editModal" title="Edit User" btnid="editdata" username="editname" userid="editname"
        emailinput="editemail" emailid="editemail"  page="edit page" rolename="editroles" :roles="$roles" />
    </section>


    <x-footer />

</x-layout>
<script>
    $(document).ready(function() {
        $("#datatable").DataTable();

        $(document).on('click', '#dltbtn', function() {
            var id = $(this).val();
            console.log(id);
            var url = "{{ route('users.destroy', ':id') }}";
            url = url.replace(':id', id);
            console.log(url);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        // cache = false,
                        success: function(response) {
                            console.log("callback function");
                            window.location.reload();
                        },
                        error: function(dataResult) {
                            console.log(dataResult);
                        }

                    });

                }
            })
        });
        // open edit modal
        $(document).on('click', '#editbtn', function() {
            var id = $(this).attr("data-id");
            var url = "{{ route('users.edit', '/id') }}";
            url = url.replace('/id', id);
            // url = '/category/edit' + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(dataResult) {
                    // console.log();
                    // console.log(dataResult);
                    $("#editModal").modal("show");
                    $("#editname").val(dataResult.name);
                    $("#editemail").val(dataResult.email);
                    // console.log(dataResult.roles[0].name);
                    $("input[name='editroles'][value=" + dataResult.roles[0].name + "]")
                        .prop('checked', true);
                    $("#editdata").val(id);
                },
                error: function(dataResult) {
                    console.log('error');
                }
            });
        });

        // edit data
        $("#editdata").click(function(e) {
            e.preventDefault();
            var name = $('#editname').val();
            var role = $('input[type="radio"][name="editroles"]:checked').val();
            var email = $('#editemail').val();
            var id = $(this).val();
            var url = "{{ route('users.update', ':id') }}";
            url = url.replace(':id', id);
            console.log(name);
            console.log(role);
            console.log(email);
            console.log(url);
            console.log(id);

            $.ajax({
                type: "PATCH",
                url: url,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'type': 1,
                    'name': name,
                    'role': role,
                    'email': email
                },
                // cache = false,
                success: function(response) {
                    console.log("callback function");
                    window.location.reload();
                },
                error: function(dataResult) {
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

        $("#adddata").click(function(e) {
            e.preventDefault();
            var name = $('#addname').val();
            var role = $('input[type="radio"][name="addroles"]:checked').val();
            var email = $('#addemail').val();
            var password = $('#password').val();
            // var url = "{{ route('users.update', ':id') }}";
            // url = url.replace(':id', id);
            console.log(name);
            console.log(role);
            console.log(email);
            console.log(password);
            // console.log(url);
            // console.log(id);

            $.ajax({
                type: "POST",
                url: "{{ route('users.store') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'type': 1,
                    'name': name,
                    'role': role,
                    'email': email,
                    'password': password
                },
                // cache = false,
                success: function(response) {
                    console.log("callback function");
                    window.location.reload();
                },
                error: function(dataResult) {
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
