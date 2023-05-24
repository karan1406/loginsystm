<x-loginsystem.layout>
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="/register" method="post">
                    @csrf
                    <x-form.input type="text" name="name" id="name" placeholder="Name" class="fas fa-user"/>
                    <x-form.error name="name" />

                    <x-form.input type="email" name="email" id="email" placeholder="Enter Email"
                        class="fas fa-envelope" />
                    <x-form.error name="email" />

                    <x-form.input type="password" name="password" id="password" placeholder="Enter Password"
                        class="fas fa-lock" />
                    <x-form.error name="password" />

                    <x-form.input type="password" name="confirm_password" id="confirm_password" placeholder="Retype Password"
                        class="fas fa-lock" />
                    <x-form.error name="confirm_password" />

                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->

                </form>
                <a href="/login" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
</x-loginsystem.layout>
