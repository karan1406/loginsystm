@can('role write')
<x-layout>

    <header>
        <x-navbar />
    </header>
    <aside>
        <x-sidebar />
    </aside>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="content-wrapper">
        <x-card.Main-card title="Add Role And Permission">

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" name="rolename" id="rolename" placeholder="Role name" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
            <p id="err-name" class="text-danger">  </p>

            <div class="text-dark mb-3 row">
                <div class="col-10">
                    Permissions :
                </div>
                <div class="col-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                        <label class="form-check-label" for="checkAll">
                            Check All
                        </label>
                    </div>
                </div>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#post"
                            aria-expanded="true" aria-controls="post">
                            Post
                        </button>
                    </h2>
                    <div id="post" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <x-show-permission find="post" page="add page"  />
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#category" aria-expanded="false" aria-controls="category">
                            Category
                        </button>
                    </h2>
                    <div id="category" class="accordion-collapse collapse p-4" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <x-show-permission find="category" page="add page"  />
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#user" aria-expanded="false" aria-controls="user">
                            User
                        </button>
                    </h2>
                    <div id="user" class="accordion-collapse collapse p-4" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <x-show-permission find="user" page="add page" />
                      </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#comment" aria-expanded="false" aria-controls="comment">
                            Role
                        </button>
                    </h2>
                    <div id="comment" class="accordion-collapse collapse p-4" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <x-show-permission find="role" page="add page" />
                      </div>
                </div>
            </div>
            <p id="err-permission" class="text-danger">  </p>


            <div class="mt-5">
                <button type="button" class="btn btn-outline-primary" id="addbtn">Add</button>
            </div>
        </x-card.Main-card>
    </section>


    <x-footer />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</x-layout>

<script>
    $(document).ready(function() {
        $("#checkAll").click(function() {
            if ($("#checkAll").is(":checked")) {
                $("input[type=checkbox]").prop('checked', true);
            } else {
                $("input[type=checkbox]").prop('checked', false);
            }
        });

        $('#addbtn').click(function() {
            var checkboxes = document.getElementsByClassName("check");
            var checkboxesChecked = [];
            // loop over them all
            for (var i = 0; i < checkboxes.length; i++) {
                // And stick the checked ones onto an array...
                if (checkboxes[i].checked) {
                    checkboxesChecked.push(checkboxes[i].value);
                }
            }
            var name = document.getElementById('rolename').value;


            $.ajax({
                type: "POST",
                url: "{{ route('roles.store') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'type': 1,
                    'name': name,
                    'permission': checkboxesChecked
                },
                // cache = false,
                success: function(response) {
                    console.log("callback function");
                    window.location.href="/roles";
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
@else
 <script>
    window.location.href = "/403"
  </script>
@endif
