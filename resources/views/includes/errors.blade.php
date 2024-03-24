@if ($errors->any())
    <div class="alert alert-danger d-flex justify-content-between">
        <ul class="m-0 text-small">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
