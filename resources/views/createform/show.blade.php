@extends('layouts.authnew-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
<?php

// echo '<pre>';
// print_r($getAll);
// die();
$fieldtype = [
    '1' => 'text',
    '2' => 'number',
    '3' => 'textarea',
    '4' => 'select',
    '5' => 'radio',
    '6' => 'checkbox'
]
?>
@section('content')
<div class="columns" style="margin-top:20px;">

    <div class="column">
        <h2 class="title">
            {{$getAll[0]['name']}}
        </h2>
        <table class="table is-striped">
            <form method="post" action="{{ route('home.submission') }}">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
               
                @endif

            @if ($errors->any())
            <div class="notification is-danger is-light">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="formid" value="{{$getAll[0]['formid']}}" />

                <form>
                    @forelse($getAll as $getAlls)
                    <tr>

                        <td>
                            <?php
                            // $fieldname = str_replace(' ', '', $getAlls['sample_field']);
                            $fieldname = $getAlls['id'];

                            if (in_array($getAlls['field_type'], ['1', '2'])) { ?>
                                <input class="form-control" type="{{$fieldtype[$getAlls['field_type']]}}" name="field[{{$fieldname}}]" value="" placeholder="{{$getAlls['label']}}" />

                            <?php } ?>

                            <?php if (in_array($getAlls['field_type'], ['5', '6'])) { ?>
                                <label>{{$getAlls['label']}}</label><br />
                                <?php $jsoncom = json_decode($getAlls['comments'], true); ?>
                                <?php foreach ($jsoncom as $keyc => $comments) { ?>
                                    <input type="{{$fieldtype[$getAlls['field_type']]}}" id="{{$keyc+1}}" name="field[{{$fieldname}}]" value="{{$keyc+1}}">
                                    <label for="{{$comments}}">{{$comments}}</label><br>

                                <?php } ?>
                            <?php } ?>
                            <?php if (in_array($getAlls['field_type'], ['3'])) { ?>
                                <label>{{$getAlls['label']}}</label>
                                <textarea class="form-control" name="field[{{$fieldname}}]">

                            </textarea>

                            <?php } ?>
                            <?php if (in_array($getAlls['field_type'], ['4'])) { ?>
                                <select class="form-control" name="field[{{$fieldname}}]">
                                    <option value="">{{$getAlls['label']}}</option>
                                    <?php $jsoncom = json_decode($getAlls['comments'], true); ?>

                                    <?php foreach ($jsoncom as $keyc => $comments) { ?>

                                        <option value="{{$keyc+1}}">{{$comments}}</option>

                                    <?php } ?>
                                </select>

                            <?php } ?>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td>No data found</td>
                    </tr>
                    @endforelse
                    <?php if (!empty($getAll)) { ?>
                        <tr>
                            <td>                <button type="submit" class="button is-info">Submit</button>
                            </td>
                        </tr>
                    <?php } ?>
                </form>
                </tbody>
        </table>

    </div>
</div>
@endsection