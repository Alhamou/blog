@extends('layouts.app')



{{-- Hear is the About Division --}}

@section('about')
    <h1>Hallo Peapole</h1>

    <ul>
        @if(count($peapole))

            @foreach( $peapole as $person)

                <li>{{$person}}</li>

            @endforeach

        @endif
    </ul>
@endsection




{{-- Hear is the footer Division --}}


@section('footer')
<p>Hallo from footer</p>

@endsection

