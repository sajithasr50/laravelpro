@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="columns" style="margin-top:20px;">

    <div class="column">
        <h2 class="title">
            Users
        </h2>
        <table class="table is-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email Id</th>
                    <th colspan="2">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse($uploadedFiles as $uploadedFile)
                <tr>
                    <td>
                        {{ $uploadedFile->username }}
                    </td>
                    <td>privilege
                        {{ $uploadedFile->email }}
                    </td>

                    <td>
                    @if($uploadedFile->role != 1)
                    <a href="{{ url('user/editprivilege/'.$uploadedFile->id) }}" data-value="{{$uploadedFile->id}}" target="_blank" class="deletecand button is-link is-small" style="background: maroon;text-decoration:none">
                        Edit Privilege  
                </a>
		@endif

                   
                    </td>
                    
                    <td>
                        {{ $uploadedFile->created_at }}
                    </td>
                   
                </tr>
                @empty
                <tr>
                    <td>No data found</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection