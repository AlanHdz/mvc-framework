@extends('layouts.app')


@section('content')
<div class="mt-4">
  <h2 class="">Register</h2>
  <form method="POST" action="/register">
        <div class="mb-2">
            <label class="form-label">Firstname</label>
            <input type="text" class="form-control {{ $errors && $errors->has('first_name') ? 'is-invalid' : '' }}"  name="first_name">
            @if ($errors && $errors->has('first_name'))
            <div class="invalid-feedback">
                {{ $errors->first_name->first() }}
            </div>
            @endif
        </div>
        <div class="mb-2">
            <label class="form-label">Lastname</label>
            <input type="text" class="form-control {{ $errors && $errors->has('last_name') ? 'is-invalid' : '' }}" name="last_name">
            @if ($errors && $errors->has('last_name'))
            <div class="invalid-feedback">
                {{ $errors->last_name->first() }}
            </div>
            @endif
        </div>
        <div class="mb-2">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control {{ $errors && $errors->has('email') ? 'is-invalid' : '' }}" name="email">
            @if ($errors && $errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->email->first() }}
            </div>
            @endif
        </div>
        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control {{ $errors && $errors->has('password') ? 'is-invalid' : '' }}">
            @if ($errors && $errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->password->first() }}
            </div>
            @endif
        </div>
        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">Password Repeat</label>
            <input type="password" name="confirm_password" class="form-control  {{ $errors && $errors->has('confirm_password') ? 'is-invalid' : '' }}">
            @if ($errors && $errors->has('confirm_password'))
            <div class="invalid-feedback">
                {{ $errors->password->first() }}
            </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection