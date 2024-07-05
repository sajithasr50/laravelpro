@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="columns" style="margin-top:20px;">

    <div class="column">

        <h2 class="title">
            Privileges
        </h2>

        <?php


        $privilege =  !empty($getAll[0]['privilege']) ? json_decode($getAll[0]['privilege'], true) : [];
        ?>

        <form action="{{ route('update-privilege') }}" method="POST">
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
                        <?php
                        $add = '';
                        $edit = '';
                        $delete = '';
                        if (in_array('1', $privilege)) {
                            $add = 1;
                        }
                        if (in_array('2', $privilege)) {
                            $edit = 1;
                        }
                        if (in_array('3', $privilege)) {
                            $delete = 1;
                        }

                        ?>

                        Add <input type="checkbox" value="1" name="priv[]" <?= ($add == 1) ? 'checked' : ''; ?>>
                        Edit <input type="checkbox" value="2" name="priv[]" <?= ($edit == 1) ? 'checked' : ''; ?>>
                        Delete <input type="checkbox" value="3" name="priv[]" <?= ($delete == 1) ? 'checked' : ''; ?>>
                    </div>

                </div>
                <input type="hidden" value="{{$getAll[0]['id']}}" name="id" />

                <div class="card-footer">
                    <button class="btn btn-success" name="ss">Submit</button>
                </div>

        </form>


    </div>
</div>

@endsection