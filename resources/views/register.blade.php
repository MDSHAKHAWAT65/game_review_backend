@extends('layout')

@section('content')

<style>
html,
body {
  height: 100%;
}

.form-signin {
  max-width: 330px;
  padding: 1rem;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}


.form-floating {
  margin-bottom: .5rem;
}

</style>

<div class="form-signin w-100 m-auto">
    <form action="/register" method="POST">
      <h1 class="h3 mb-3 fw-normal">Register an account</h1>

      @include('includes/errors')
      @include('includes/alert_success')
      @include('includes/alert_failed')

      @csrf
      <div class="form-floating">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Name">
        <label for="floatingInput">Name</label>
      </div>
      <div class="form-floating">
        <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
  
      <div class="text-start my-3">
        <a href="/login">Already an account? Login</a>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
    </form>
</div>

@endsection
