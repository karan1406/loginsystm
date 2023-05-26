<x-layout>
    <header>
        <x-navbar />
    </header>
    <aside>
        <x-sidebar />
    </aside>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="content-wrapper">
        <x-card.Main-card title="Manage Roles and Permission">
            <div class="container">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created at</th>
                            @canany(['role edit', 'role delete'])
                                <th> Action </th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($roles as $role)
                            @if ($role->name == 'Super Admin')
                                @continue
                            @endif
                            <tr>
                                <td id="namevalue"> {{ $role->name }} </td>
                                <td id="create"> {{ $role->created_at->format('Y m,d') }} </td>

                                @if ($role->name == 'visitor')
                                    <td> <img src="/images/trash.jpg" height="50" width="50"> </td>
                                @else
                                    @canany(['role edit', 'role delete'])
                                        <td>
                                            @can('role edit')
                                                <a type="button" role="button" href="{{ route('roles.edit', $role->id) }}"
                                                    class="btn btn-primary" id="editbtn"> <i class="icon-edit"
                                                        style="font-size: 20px"></i></a>
                                            @endcan
                                            @can('role delete')
                                                <button type="button" class="btn btn-danger" id="dltbtn"
                                                    value="{{ $role->id }}"><i class="icon-trash"
                                                        style="font-size: 20px"></i></button>
                                            @endcan
                                        </td>
                                    @endcanany
                                @endif

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
        </x-card.Main-card>
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
                type: "POST",
                url: "{{ route('roles.store') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'type': 1,
                    'name': name,
                    'permission': permissions
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

        $(document).on('click', '#dltbtn', function() {
            var id = $(this).val();
            console.log(id);
            var url = "{{ route('roles.destroy', ':id') }}";
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
                type: "PATCH",
                url: url,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'type': 1,
                    'name': name,
                    'status': status,
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
            type: "post",
            url: url,
            data: {
                '_token': '{{ csrf_token() }}',
                'state': status,
                'permission': permission,
            },
            success: function(response) {
                console.log("callback function");
                window.location.reload();
            },
            error: function(dataResult) {
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
