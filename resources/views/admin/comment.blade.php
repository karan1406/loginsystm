<x-layout>
    <header>
        <x-navbar />
    </header>
    <aside>
        <x-sidebar />
    </aside>
    <link rel="stylesheet" href="/css/admin.css" />

    <section class="content-wrapper">
        <x-card.Main-card title="Manage Comment">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Body</th>
                        <th>User Name</th>
                        <th>Category</th>
                        <th>Post Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)

                    <tr>
                        <td> {{ $comment->body}}</td>
                        @foreach ($comment->users as $user)
                        <td> {{ $user->name}}</td>
                        @endforeach
                        <td> {{ $comment->post->category->name}}</td>
                        <td> {{ $comment->post->name}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" id="dltbtn" value="{{ $comment->id }}"><i class="icon-trash" style="font-size: 20px"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card.Main-card>
    </section>

    <x-footer />
    <!-- Button trigger modal -->



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

    // Delete Category
    $(document).on('click', '#dltbtn', function() {
        var id = $(this).val();
        console.log(id);
        var url = "{{ route('comments.destroy', ':id') }}";
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
</script>
