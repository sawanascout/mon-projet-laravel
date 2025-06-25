@extends('layouts.app') {{-- ou layouts.app selon ton setup --}}
@php use Illuminate\Support\Str; @endphp

@section('title', 'Clics de Parrainage')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📈 Liste des clics de parrainage</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Parrain</th>
                <th>Email</th>
                <th>Code Parrain</th>
                <th>IP</th>
                <th>Appareil</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clics as $index => $clic)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $clic->user->name ?? 'N/A' }}</td>
                    <td>{{ $clic->user->email ?? 'N/A' }}</td>
                    <td>{{ $clic->user->referral_code ?? 'N/A' }}</td>
                    <td>{{ $clic->ip_address }}</td>
                    <td>{{ Str::limit($clic->user_agent, 50) }}</td>
                    <td>{{ $clic->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection