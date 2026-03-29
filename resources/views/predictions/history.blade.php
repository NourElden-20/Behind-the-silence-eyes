
@extends('layouts.app')

@section('main-content')
<div class="container-fluid py-4">

    {{-- Title --}}
    <h4 class="fw-bold mb-4">Prediction History</h4>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table align-middle text-center">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Disease</th>
                            <th>Severity</th>
                            <th>Confidence</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($predictions as $prediction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- Image --}}
                                <td>
                                    <img src="{{ asset('storage/' . $prediction->image_path) }}"
                                        class="rounded"
                                        style="width:70px; height:70px; object-fit:cover;">
                                </td>

                                {{-- Disease --}}
                                <td class="fw-bold text-capitalize">
                                    {{ $prediction->disease_type }}
                                </td>

                                {{-- Severity --}}
                                <td>
                                    @if($prediction->severity)
                                        <span class="badge bg-info">
                                            {{ $prediction->severity }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- Confidence --}}
                                <td>
                                    <span class="fw-bold text-success">
                                        {{ $prediction->confidence }}%
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td>
                                        <span class="badge bg-primary">
                                            {{ $prediction->status }}
                                        </span>
                                    
                                </td>

                                {{-- Notes --}}
                                <td>
                                    {{ $prediction->notes ?? '-' }}
                                </td>

                                {{-- Date --}}
                                <td>
                                    {{ $prediction->created_at->format('Y-m-d') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-muted py-4">
                                    No predictions found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection


