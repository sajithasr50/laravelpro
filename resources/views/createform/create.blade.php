@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="container">
    <div class="columns">
        <div class="column">

            <h1 class="title">Add New form</h1>
            @if ($errors->any())
            <div class="notification is-danger is-light">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('createform.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name" required="required" autofocus>
                    @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <table class="table table-bordered table-hover dynamicfield" id="dynamic_field">
                    <tr id="row0">
                        <td class="type_list"><input type="text" name="field[0][label]" placeholder="Label" class="form-control typeClass" /></td>
                        <td class=""><input type="text" name="field[0][sample_field]" placeholder="Sample Field" class="form-control typeClass" /></td>
                        <td><select class="form-control" name="field[0][field_type]">
                                <option value="">Select Type</option>
                                <option value="1">Text</option>
                                <option value="2">Number</option>
                                <option value="3">Textarea</option>
                                <option value="4">Select</option>
                                <option value="5">Radio</option>
                                <option value="6">Checkbox</option>
                            </select></td>
                        <td>
                            <div class="field_wrapper0" style="width:100%"><input type="text" style="width:50%;float:left" class="form-control" name="field[0][comments][]" value=""><a style="width:50%; float:left" data-id="0" href="javascript:void(0);" class="add_button" title="Add field">Add</a></div>
                        </td>
                        <td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></td>
                    </tr>
                </table>


        </div>

        <div class="field is-grouped mt-3">
            <div class="control">
                <button type="submit" class="button is-info">Save</button>
            </div>
            <div class="control">
                <a href="{{ route('createform.index') }}" class="button is-light">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection