@extends('layout.web')


@section('content')

<form action="{{ route("split.res") }}" method="POST">
    @csrf
        <button type="submit">Split.res</button>
</form>

@endsection


