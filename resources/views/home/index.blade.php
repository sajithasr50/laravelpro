@extends('layouts.app-master')
<style>
    .select {
        position: relative
    }

    .select .field {
        width: 100%;
        background: #ddd;
        color: #000;
        padding: 5px;
        border: none;
    }

    .select>ul.list {
        //display:none;
        position: absolute;
        left: 0px;
        top: 26px;
        width: 50%;
        margin: 0;
        padding: 5px;
        list-style: none;
        background: #ddd;
        color: #333;
    }

    .select>ul.list li:not(.diff) {
        padding: 1em;
        /* .7 */
        margin: .5em;
        width: 95%;
        text-align: left;
        display: inline-block;
        background: #eee;
        border: 1px solid #999;
    }

    .select>ul.list li:hover {
        background: #555;
        color: #ddd;
    }

    .select>ul.list .diff {
        width: 100%;
    }

    .select>ul.list .line {
        border-bottom: 1px solid black;
        margin: 15px 0;
    }

    .select>ul.list .space {
        margin: 25px 0;
    }

    .select>ul.list li.selected {
        background: #555;
        color: #ddd;
    }

    .select>ul.list li.disabled {
        background-color: #999;
        color: #777;
        cursor: not-allowed;
        opacity: .5;
    }

    .votebtn {
        width: 50%;
        float: right;
        position: relative;
        margin: auto;

    }

    .btn-success {
        margin-top: 27px;
        margin-left: 19px;
        width: 50%;
    }

    .row {
        margin-right: -15px;
        margin-left: -15px;
    }

    .col-lg-3,
    .col-md-6,
    .col-xs-3 {
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }

    .col-xs-3 {
        float: left;
        width: 20%;
    }

    .col-xs-9 {
        width: 75%;
        float: left;
    }

    .clearfix:after {
        clear: both;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: " ";
    }

    .panel {
        margin-bottom: 10px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    }

    .panel-footer {
        padding: 10px 15px;
        background-color: #f5f5f5;
        border-top: 1px solid #ddd;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }

    .panel-heading {
        height: 100px;
        background-color: turquoise;
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .panel-green {
        border: 2px dashed #398439;
    }

    .panel-green .panel-heading {
        background-color: #398439;
    }

    .green {
        color: #398439;
    }

    .blue {
        color: #337ab7;
    }

    .red {
        color: #ce7f7f;
    }

    .panel-primary {
        border: 2px dashed #337ab7;
    }

    .panel-primary .panel-heading {
        background-color: #337ab7;
    }

    .yellow {
        color: #ffcc00;
    }

    .panel-yellow {
        border: 2px dashed #ffcc00;
    }

    .panel-yellow .panel-heading {
        background-color: #ffcc00;
    }

    .panel-red {
        border: 2px dashed #ce7f7f;
    }

    .panel-red .panel-heading {
        background-color: #ce7f7f;
    }

    .huge {
        font-size: 30px;
    }

    .panel-heading {
        color: #fff;
    }

    .pull-left {
        float: left !important;
    }

    .pull-right {
        float: right !important;
    }

    .text-right {
        text-align: right;
    }

    .under-number {
        font-size: 20px;
    }

    @media (min-width: 992px) {
        .col-md-6 {
            float: left;
            width: 50%;
        }
    }

    @media (min-width: 1200px) {
        .col-lg-3 {
            float: left;
            width: 20%;
        }
    }
</style>
@section('content')

<div class="bg-light p-5 rounded">

    @auth
    @if(auth()->user()->role == 1)
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class='huge'></div>
                            <div class="under-number">Users</div>
                        </div>
                    </div>
                </div>
                <a href="posts.php">
                    <div class="panel-footer">
                        <span class="pull-left blue"><a style="text-decoration: none;" href="{{ route('user.list') }}">View Details</a></span>
                        <span class="pull-right blue"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- ********************************************************************************************************* -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class='huge'></div>
                            <div class="under-number">Forms</div>
                        </div>
                    </div>
                </div>
                <a href="comments.php">
                    <div class="panel-footer">
                        <span class="pull-left green"><a style="text-decoration: none;" href="{{ route('createform.index') }}">View Details</a></span>
                        <span class="pull-right green"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        @endif
        @if(auth()->user()->role == 2)

        <h1>Hi <span style="color:maroon;text-transform:Capitalise;"><?= $userdata['username']; ?></span>, Welcome </h1>

        @endif

        @endauth
        @guest
        <h1>Admin PANEL</h1>
        <p class="lead">Please Login to the system and create new forms</p>
        @endguest
    </div>
    @endsection