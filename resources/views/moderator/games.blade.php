@extends('moderator/dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Games</h1>

    <a class="btn btn-sm btn-primary" href="/games/add">Add Game</a>
</div>


<div class="card">
    <div class="card-body">

        @include('includes/errors')
        @include('includes/alert_success')
        @include('includes/alert_failed')

        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Image</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($games as $game)
            <tr>
              <th scope="row">{{ $games->firstItem() + $loop->index }}</th>
              <td>{{ $game->title }}</td>
              <td>  <img width="50" class="circle" src="{{ asset($game->img_url) }}" alt=""/></td>
              <td>{{ $game->status ? 'Active' : 'Inactive' }}</td>
            </tr>
            @endforeach

          </tbody>
        </table>

    </div>
</div>
@endsection