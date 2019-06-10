@extends('layouts.app')

@section('content')
    <div id="profile"></div>
@endsection

@push('javascript')
    <script src="{{asset('js/profile.js')}} "></script>
@endpush