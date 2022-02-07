@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-3">Change Password</h1>

        {{-- ---------- Start of Form Errors ---------- --}}
        @include('common.errors')
        {{-- ---------- End of Form Errors ---------- --}}

        <div class="mb-4">
            {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) }}
            {{ Form::token() }}
            <div class="form-grop mb-3">
                New password: {{ Form::password('password', array('Placeholder' => 'New Password')) }}
            </div>
            <div class="form-group mb-3">
                Password Confirm: {{ Form::password('password_confirmation', array('Placeholder' => 'Password Confirm')) }}
            </div>
            <div class="form-group mb-3">
                {{ Form::submit('Update password', array('class' => 'btn btn-primary')) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
