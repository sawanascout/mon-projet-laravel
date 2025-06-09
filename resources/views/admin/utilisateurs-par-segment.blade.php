@extends('layouts.admin')

@section('content')
<h1>Utilisateurs clients par segment (du {{ $start_date }} au {{ $end_date }})</h1>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Segment</th>
            <th>Nombre d'utilisateurs</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($utilisateurs as $segmentData)
            <tr>
                <td>{{ $segmentData->segment }}</td>
                <td>{{ $segmentData->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
