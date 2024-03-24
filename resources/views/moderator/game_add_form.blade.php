@extends('moderator/dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Game</h1>
</div>


<div class="card">
    <div class="card-body">

        @include('includes/errors')
        @include('includes/alert_success')
        @include('includes/alert_failed')

        <form class="row g-3" action="/games/add" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
              <label class="form-label">Game Title</label>
              <input type="text" class="form-control" name="title">
            </div>
            <div class="col-md-6">
              <label class="form-label">Game Image</label>
              <input type="file" class="form-control" name="image">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Status</label>
                <select id="inputState" class="form-select" name="status">
                  <option selected>Choose...</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>

            <div class="col-12">
              <button type="submit" class="btn btn-primary">Add Game</button>
            </div>
        </form>
    </div>
</div>
@endsection