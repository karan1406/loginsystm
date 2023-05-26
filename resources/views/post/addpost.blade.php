@can('post write')
<x-layout>
    <header>
        <x-navbar />
    </header>
    <aside>
        <x-sidebar />
    </aside>


    <section class="content-wrapper">
        <x-card.Main-card title="Add Post">
            <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label for="category">Select Category</label>
                        <select class="form-control" name="category_id" id="category">
                            <option value="Seleted category" selected> Chose category </option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{  old('category_id') == $category->id ? 'selected' : ' ' }}> {{$category->name}} </option>
                            @endforeach
                        </select>
                        <x-form.error name="category_id" />

                    </div>
                    <div class="col-6">
                        <label for="title">Enter Title</label>
                        <x-form.input type="text" placeholder="Enter Title" name="name" id="title" class="icon-pencil" />
                        <x-form.error name="name" />

                    </div>
                </div>
                <label for="slug"> Enter Slug</label>
                <x-form.input type="text" placeholder="Enter Slug(Space not allowed)" name="slug" id="slug" class="icon-pencil" />
                <x-form.error name="slug" />
                <x-form.textarea title="Enter Excerpt" placeholder="Enter Sort Description here.." name="excerpt" id="excerpt" />
                <x-form.error name="excerpt" />
                <x-form.textarea title="Enter Body" placeholder="Enter Description here.." name="body" id="body" />
                <x-form.error name="body" />
                <div class="mt-3">
                    <label for="status">Thumbnail</label>
                </div>
                <x-form.input type="file" name="image" id="image" placeholder="Select image"/>
                <x-form.error name="image" />

                <button type="submit" class="btn btn-primary">Add Post</button>
            </form>
        </x-card.Main-card>
    </section>

    <x-footer />

</x-layout>
<script>
    $(document).ready(function() {
        $('#body').summernote({
            placeholder: 'Enter Description Here..'
            , tabsize: 2
            , height: 100
            , popover: {
                image: [
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']]
                    , ['float', ['floatLeft', 'floatRight', 'floatNone']]
                    , ['remove', ['removeMedia']]
                    , ['custom', ['imageAttributes']]
                , ]
            , }
        , });

        $('#image').dropify();
    });

</script>
@else
 <script>
    window.location.href = "/403"
  </script>
@endif
