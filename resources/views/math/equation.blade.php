@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h3 class="text-center mb-4">Persamaan Kuadrat</h3>
            <p class="text-muted text-center small">Format: ax² + bx + c = 0</p>
            <form action="{{ route('math.equation') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-4 mb-3">
                        <label>Nilai a</label>
                        <input type="number" name="a" class="form-control" placeholder="1" required>
                    </div>
                    <div class="col-4 mb-3">
                        <label>Nilai b</label>
                        <input type="number" name="b" class="form-control" placeholder="2" required>
                    </div>
                    <div class="col-4 mb-3">
                        <label>Nilai c</label>
                        <input type="number" name="c" class="form-control" placeholder="1" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark w-100">Cari Akar x</button>
            </form>

            @if(isset($result))
                <div class="alert alert-info mt-4 text-center">
                    <h5>Penyelesaian: <br><strong>{{ $result }}</strong></h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection