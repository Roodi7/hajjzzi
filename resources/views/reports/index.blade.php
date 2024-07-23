@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Generate Report</h1>
        <form action="{{ route('reports.show') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="accommodation_id">Select Accommodation</label>
                <select name="accommodation_id" class="form-control" required>
                    @foreach ($accommodations as $accommodation)
                        <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
    </div>
@endsection
