@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="columns" style="margin-top:20px;">

    <div class="column">
        <h2 class="title">
            Profile Details
        </h2>

        <table class="table no-stripped">

            <tbody>
                <tr>
                    <td>
                        Username : {{ auth()->user()->username }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Email : {{ auth()->user()->email }}

                    </td>

                </tr>

                <tr>
                    <td>
                        User Role : <?= (auth()->user()->role == 1) ? 'Admin' : 'Normal User'; ?>

                    </td>

                </tr>
                <tr>
                    <td>
                        Account created : {{ auth()->user()->created_at }}

                    </td>

                </tr>

            </tbody>
        </table>
        <!-- <h2 class="title">
            Privileges
        </h2> -->
        
    </div>

    <!-- <form action="{{ route('update-privilege') }}" method="POST">
            @csrf
            <div class="card-body">
                @if (session('statuspriv'))
                <div class="alert alert-success" role="alert">
                    {{ session('statuspriv') }}
                </div>
                @elseif (session('errorpriv'))
                <div class="alert alert-danger" role="alert">
                    {{ session('errorpriv') }}
                </div>
                @endif


            <div class="card-body">

                <div class="mb-3">
                    Add <input type="checkbox" value="1" name="priv[]">
                    Edit <input type="checkbox" value="2" name="priv[]">
                    Delete <input type="checkbox" value="3" name="priv[]">
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-success" name="ss">Submit</button>
            </div>

        </form> -->

    <div class="column">
        <h2 class="title">
            Password Change
        </h2>
        <form action="{{ route('update-password') }}" method="POST">
            @csrf
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @elseif (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                <div class="mb-3">
                    <label for="oldPasswordInput" class="form-label">Old Password</label>
                    <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput" placeholder="Old Password">
                    @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="newPasswordInput" class="form-label">New Password</label>
                    <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" placeholder="New Password">
                    @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                    <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput" placeholder="Confirm New Password">
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-success">Submit</button>
            </div>

        </form>


    </div>
</div>
@endsection