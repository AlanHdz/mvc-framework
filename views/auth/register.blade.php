@extends('layouts.app')


@section('content')
<div class="mt-4">
  <h2 class="">Register</h2>
  <form method="POST" action="/register">
        <div class="mb-2">
            <label class="form-label">Firstname</label>
            <input type="text" class="form-control {{ $model->hasError('firstName') ? 'is-invalid' : '' }}" name="firstName" value="{{ $model->firstName }}">
            <div class="invalid-feedback">
                {{ $model->getFirstError('firstName') }}
            </div>
        </div>
        <div class="mb-2">
            <label class="form-label">Lastname</label>
            <input type="text" class="form-control" name="lastName">
        </div>
        <div class="mb-2">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">Password Repeat</label>
            <input type="password" name="confirmPassword" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection