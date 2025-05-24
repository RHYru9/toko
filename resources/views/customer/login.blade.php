@extends('v_layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Login Customer</h4>
                </div>

                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form method="POST" action="{{ url('customer/login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">Login</button>
                        </div>
                    </form>

                    <!-- Tambahkan tombol login dengan Google -->
                    <div class="text-center my-3">
                        <p class="text-muted">Atau login dengan</p>
                        <a href="{{ route('auth.google') }}" class="btn btn-outline-danger">
                            <i class="fab fa-google me-2"></i> Google
                        </a>
                    </div>

                    <div class="mt-3 text-center">
                        <p>Belum punya akun? <a href="x">Daftar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
