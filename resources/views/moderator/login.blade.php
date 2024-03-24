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

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>

<div class="form-signin w-100 m-auto">
    <form action="/login" method="POST">
      <h1 class="h3 mb-3 fw-normal">Moderator sign in</h1>

      @include('includes/errors')
      @include('includes/alert_success')
      @include('includes/alert_failed')

      @csrf
      <div class="form-floating">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
  
      <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    </form>
</div>

@endsection
