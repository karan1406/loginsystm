<x-layout>
    <header>
        <x-navbar />
    </header>
    <aside>
        <x-sidebar />
    </aside>


    <section class="content-wrapper">
        <x-card.Main-card title="Manage Post">
            <div class="container">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Category Name</th>
                            <th>Post Name </th>
                            <th>Status</th>

                            <th>Posted By</th>
                            <th> Image </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td id="categorynameval">{{ Str::ucfirst($post->category->name) }}</td>
                            <td id="nameval">{{ Str::ucfirst($post->name) }}</td>

                            <td id="status">{{ $post->status == '1' ? 'Active' : 'Inactive' }}</td>

                            <td>{{ $post->user->name }}</td>
                            <td> <img src="{{$post->image}}" height="100" width="100"></td>
                            <td> 
                                <a name="editbtn" id="editbtn" class="btn btn-primary" href="{{route('posts.edit',$post->id)}}" role="button"> <i class="icon-edit" style="font-size: 20px"></i></a>
                                <button type="button" class="btn btn-danger" id="dltbtn" value="{{ $post->id }}"><i class="icon-trash" style="font-size: 20px"></i></button>
                            </td>
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

        $(document).on('click', '#dltbtn', function() {
            var id = $(this).val();
            console.log(id);
            var url = "{{ route('posts.destroy', ':id') }}";
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
                            window.location.reload();
                        }
                        , error: function(dataResult) {
                            console.log(dataResult);
                        }

                    });

                }
            })
        });

    });

</script>
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