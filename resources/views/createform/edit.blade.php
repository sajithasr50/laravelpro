@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="container">
    <div class="columns">
        <div class="column">

            <h1 class="title">Edit form</h1>
            @if ($errors->any())
            <div class="notification is-danger is-light">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('createform.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="name" value="{{$getAll[0]['name']}}" placeholder="name" required="required" autofocus>
                    @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <input type="hidden" value="{{$getAll[0]['formid']}}" name="formId" id="formId" />

                <table class="table table-bordered table-hover dynamicfield" id="dynamic_field">
                    <?php
                    for ($i = 0; $i < count($getAll); $i++) {
                        $comments = json_decode($getAll[$i]['comments']);
                        $commentfirst = "";
                        if ($comments[0] != null && $comments[0] != "") {
                            $commentfirst = $comments[0];
                        }
                    ?>
                        <tr id="row<?= $i; ?>">
                            <td class="type_list"><input type="text" value="<?= !empty($getAll[$i]['label']) ? $getAll[$i]['label'] : ''; ?>" name="field[{{$i}}][label]" placeholder="Label" class="form-control typeClass" /></td>
                            <td class=""><input type="text" value="<?= !empty($getAll[$i]['sample_field']) ? $getAll[$i]['sample_field'] : ''; ?>" name="field[{{$i}}][sample_field]" placeholder="Sample Field" class="form-control typeClass" /></td>
                            <td><select class="form-control" name="field[{{$i}}][field_type]">
                                    <option value="">Select Type</option>
                                    <option <?= ($getAll[$i]['field_type'] == 1) ? 'selected' : ''; ?> value="1">Text</option>
                                    <option <?= ($getAll[$i]['field_type'] == 2) ? 'selected' : ''; ?> value="2">Number</option>
                                    <option <?= ($getAll[$i]['field_type'] == 3) ? 'selected' : ''; ?> value="3">Textarea</option>
                                    <option <?= ($getAll[$i]['field_type'] == 4) ? 'selected' : ''; ?> value="4">Select</option>
                                    <option value="5" <?= ($getAll[$i]['field_type'] == 5) ? 'selected' : ''; ?>>Radio</option>
                                    <option value="6" <?= ($getAll[$i]['field_type'] == 6) ? 'selected' : ''; ?>>Checkbox</option>
                                </select></td>
                            <td>
                                <div class="field_wrapper{{$i}}" style="width:100%">
                                    <input type="text" value="<?= $commentfirst; ?>" style="width:50%;float:left" class="form-control" name="field[{{$i}}][comments][]" value=""><a style="width:50%; float:left" data-id="{{$i}}" href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                    <?php
                                    if (count($comments) > 1) {
                                        for ($j = 1; $j < count($comments); $j++) {
                                            $commentrow = "";
                                            if ($comments[$j] != null && $comments[$j] != "") {
                                                $commentrow = $comments[$j];
                                            } ?>
                                            <div id="rows<?= $j; ?>" style="width:100%;float:left;padding-top:10px;" class="dynamicc">
                                                <input class="form-control" value="{{$commentrow}}" style="width:50%;float:left" type="text" name="field[{{$j}}][comments][]" value="">
                                                <a href="javascript:void(0);" class="remove_button" style="width:50%; float:left">Remove</a>
                                            </div>
                                    <?php }
                                    }

                                    ?>
                                </div>
                            </td>
                            <?php if ($i == 0) { ?>
                                <td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></td>
                            <?php } else { ?>
                                <td><button type="button" name="remove" id="{{$i}}" class="btn btn-danger btn_remove">X</button></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>


                <!-- <div class="form-group mb-3">
                    <div class="col-md-3" style="float-left">
                    <input type="text" class="form-control" name="field[0][label]" value="" placeholder="label" required="required" autofocus>
                    @if ($errors->has('label'))
                    <span class="text-danger text-left">{{ $errors->first('label') }}</span>
                    @endif
                    </div> -->
                <!-- <div class="col-md-3">
                    <input type="text" class="form-control" name="field[0][sample_field]" value="" placeholder="sample_field" required="required" autofocus>
                    <label for="floatingName">Sample Field</label>
                    @if ($errors->has('sample_field'))
                    <span class="text-danger text-left">{{ $errors->first('sample_field') }}</span>
                    @endif
                    </div> -->

                <!-- <select class="form-control" name="field[0][field_type]"  placeholder="type" required="required" autofocus>
                        <option value="0">Type</option>
                        <option value="1">Text</option>
                        <option value="2">Number</option>
                        <option value="3">Textarea</option>
                        <option value="4">Select</option>
                        <option value="5">Radio</option>
                        <option value="6">Checkbox</option>
                    </select>

                    @if ($errors->has('field_type'))
                    <span class="text-danger text-left">{{ $errors->first('field_type') }}</span>
                    @endif -->

                <!-- <label>Values</label>

                <div class="form-group form-floating mb-3">

                <div class="field_wrapper" style="width:100%">

                    <input type="text" style="width:50%;float:left" class="form-control" name="field[0][comments][]" value="">
                    <a style="width:50%; float:left" data-id="0"  href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                </div>
                    @if ($errors->has('comments'))
                    <span class="text-danger text-left">{{ $errors->first('comments') }}</span>
                    @endif
                </div> -->

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