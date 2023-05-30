<x-layout>
    <header>
        <x-navbar />
    </header>
    <aside>
        <x-sidebar />
    </aside>
    <link rel="stylesheet" href="/css/admin.css" />

    <section class="content-wrapper">
        <x-card.Main-card title="Manage Category">
            <!-- /.card-header -->

            <div class="container">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Category Name</th>
                            <th>Category Slug </th>
                            <th>Status</th>
                            <th>Created By</th>
                            @canany(['category edit', 'category delete'])
                                <th> Action </th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td id="nameval">{{ Str::ucfirst($category->name) }}</td>
                                <td id="slugval">{{ Str::ucfirst($category->slug) }}</td>


                                <td id="tr-table">
                                    <p>
                                        <input type="checkbox" id="switch3-{{ $category->id }}" switch="bool"
                                            {{ $category->status == '1' ? 'checked' : ' ' }} value="{{ $category->id }}"
                                            onchange="editStatus({{ $category->id }})"
                                            @can('category edit')
                                    @disabled(false)
                                    @else
                                    @disabled(true)

                                    @endcan>
                                        <label for="switch3-{{ $category->id }}" data-on-label="Active"
                                            data-off-label="Inactive"></label>
                                    </p>
                                </td>

                                <td>{{ $category->user->name }}</td>
                                @canany(['category edit', 'category delete'])
                                    <td>
                                        @can('category edit')
                                            <button type="button" class="btn btn-primary" id="editbtn"
                                                value="{{ $category->id }}"><i class="icon-edit" style="font-size: 20px"></i>
                                            </button>
                                        @endcan
                                        @can('category delete')
                                            <button type="button" class="btn btn-danger" id="dltbtn"
                                                value="{{ $category->id }}"><i class="icon-trash"
                                                    style="font-size: 20px"></i></button>
                                        @endcan
                                    </td>
                                @endcanany
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </x-card.Main-card>
    </section>

    <x-footer />
    <!-- Button trigger modal -->


    <x-modal idname="addModal" title="Add Category" btnid="adddata" nameinput1="name" idinput1="name" nameinput2="slug"
        idinput2="slug" status="status" />
    <x-modal idname="editModal" title="Add Edit Category" btnid="editdata" nameinput1="editname" idinput1="editname"
        nameinput2="editslug" idinput2="editslug" status="status2" />

</x-layout>
@if (session()->get('success'))
    <script>
        toastr["success"]("{{ session('success') }}");
    </script>
@endif

<script>
    $(document).ready(function() {
        $("#datatable").DataTable();
    });
    $(document).ready(function() {
        // add category
        $("#adddata").click(function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var slug = $('#slug').val();
            console.log(name);
            console.log(status);
            console.log(slug);


            $.ajax({
                type: "POST",
                url: "{{ route('category.store') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'type': 1,
                    'name': name,
                    'slug': slug
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

        //Open EDit Category Modal
        $(document).on('click', '#editbtn', function() {
            var id = $(this).val();
            var name = $(this).parents("tr").find("#nameval").text();
            var slug = $(this).parents("tr").find("#slugval").text();
            $('#editModal').modal('show');
            $('#editname').val(name);
            $('#editslug').val(slug);
            $('#editdata').val(id);
        });
        // Edit
        $("#editdata").click(function(e) {
            e.preventDefault();
            var name = $('#editname').val();
            var status = $('input[type="radio"][name="status2"]:checked').val();
            var slug = $('#editslug').val();
            var id = $(this).val();
            var url = "{{ route('category.update', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "PATCH",
                url: url,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'type': 1,
                    'name': name,
                    'status': status,
                    'slug': slug
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


        // Delete Category
        $(document).on('click', '#dltbtn', function() {
            var id = $(this).val();
            console.log(id);
            var url = "{{ route('category.destroy', ':id') }}";
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


    });

    function editStatus(id) {
        console.log(id);
        var val = $('#switch3' + '-' + id).is(":checked");
        console.log(val);
        var status = (val == false ? 0 : 1);
        var url = '/category/updateState/' + id;
        console.log(status);
        $.ajax({
            type: "PATCH",
            url: url,
            data: {
                '_token': '{{ csrf_token() }}',
                'status': status
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

    $('.modal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    })
</script>
