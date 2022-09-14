@extends('backpack::layouts.top_left')

@section('content')

<div class="container">

    @include('team-management::teams.header')
    @include('team-management::teams.members')

</div>
@endsection

@section('after_scripts')
<script src="{{ mix('js/app.js') }}"></script>
@endsection
