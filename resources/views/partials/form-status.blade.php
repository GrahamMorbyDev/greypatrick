@if (session('status'))
  <div class="form-alert form-alert-success" role="status">
    {{ session('status') }}
  </div>
@endif

@if ($errors->any())
  <div class="form-alert form-alert-error" role="alert">
    <strong>Please check the form.</strong>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
