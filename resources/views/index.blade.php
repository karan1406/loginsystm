<x-loginsystem.layout>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="/login" method="post">
                    @csrf
                        <x-form.input  type="email" name="email" id="email" placeholder="Enter Email" class="fas fa-envelope" />
                        <x-form.error name="email" />
                        <x-form.input  type="password" name="password" id="password" placeholder="Enter Password" class="fas fa-lock" />
                        <x-form.error name="password" />

                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->

                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="/register" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</x-loginsystem.layout>
