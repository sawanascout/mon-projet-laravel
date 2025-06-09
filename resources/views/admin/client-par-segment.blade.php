@extends('layouts.admin')

@section('content')
<h1>Clients avec commandes par segment</h1>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Segment</th>
            <th>Nombre de clients</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $clientSegment)
            <tr>
                <td>{{ $clientSegment->segment }}</td>
                <td>{{ $clientSegment->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
