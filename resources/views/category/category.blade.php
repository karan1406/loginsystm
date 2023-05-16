<x-layout>
    <header>
        <x-navbar />
    </header>
    <aside>
        <x-sidebar />
    </aside>


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
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td id="nameval">{{ Str::ucfirst($category->name) }}</td>
                                    <td id="slugval">{{ Str::ucfirst($category->slug) }}</td>
                                    <td id="status">{{ $category->status == '1' ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $category->user->name }}</td>
                                    <td> <button type="button" class="btn btn-primary" id="editbtn"
                                            value="{{ $category->id }}"><i class="icon-edit"
                                                style="font-size: 20px"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" id="dltbtn"
                                            value="{{ $category->id }}"><i class="icon-trash"
                                                style="font-size: 20px"></i></button>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

        </x-card.Main-card>
    </section>

    <x-footer />
    <!-- Button trigger modal -->


    <x-modal idname="addModal" title="Add Category" btnid="adddata" name1="name" id1="name" name2="slug"
        id2="slug" status="status" />
    <x-modal idname="editModal" title="Add Edit Category" btnid="editdata" name1="editname" id1="editname"
        name2="editslug" id2="editslug" status="status2" />

</x-layout>
@if (session()->get('success'))
    <script>
        $.toast({
            heading: 'Success',
            text: '{{ session('success') }}',
            position: 'top-left',
            icon: 'success',
            stack: false
        });
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
            var status = $('input[type="radio"][name="status"]:checked').val();
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

        //Open EDit Category Modal
        $(document).on('click', '#editbtn', function() {
            var id = $(this).val();
            var name =
                $(this).parents("tr").find("#nameval").text();
            var slug = $(this).parents("tr").find("#slugval").text();
            var status = $(this).parents("tr").find("#status").text() == 'Active' ? 1 : 0;

            $('#editModal').modal('show');
            $('#editname').val(name);
            $('#editslug').val(slug);
            $('#editdata').val(id);
            if (status == 0) {
                $("input[name='status2'][value='0']").prop('checked', true);
            } else {
                $("input[name='status2'][value='1']").prop('checked', true);
            }
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
</script>
