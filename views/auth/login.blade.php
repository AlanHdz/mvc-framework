@extends('layouts.app')


@section('content')
<div class="mt-4">
  <h2 class="">Login</h2>
  <form method="POST" action="/login">
        <div class="mb-2">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="passwod" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
@endsection