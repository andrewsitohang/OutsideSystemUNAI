<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.links')
    <title>Login | Guaranter UNAI Outside System</title>
</head>
<body>

<div class="page-content d-flex justify-content-center" style="background-color: #32323a; min-height: 100vh;">
  <div class="row mx-0 auth-page">
    <div class="mx-auto" style="margin-top: 75px">
    <div class="card mx-auto" style="border: none; width: 350px; border-top-left-radius: 20px;border-top-right-radius: 20px">
        <div class="row">
            <div class="auth-form-wrapper justify-content-center">
              <div class="text-center py-5" style="background-color: #38BBEB; border-bottom: 10px solid #2D9DC6; border-top-left-radius: 10px; border-top-right-radius: 10px; border-top-left-radius: 10px;border-top-right-radius: 10px">
                <h4 class="fw-bolder d-block text-white">Universitas Advent Indonesia</h4>
                <h5 class="fw-normal text-white" style="font-family: 'Open Sans',sans-serif;">Outside System for Guaranter</h5>
              </div>
              <div>
                @if (session()->has('success'))  
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                @if (session()->has('loginError'))  
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form class="forms-sample" action="/penjamin/login" method="POST">
                  @csrf
                  <div class="p-4" style="background-color: #EAEAEC">
                    <div class="mb-3">
                      <input type="username" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username">
                      @error('username')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                      @error('username')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                  <div class="bg-white pt-3 pb-4" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px">
                    <div class="form-check mb-3">
                      <div style="font-size: 12px;">Belum memiliki akun? Daftar
                        <a href="/penjamin/register" style="color: #1cb4ac; text-decoration: underline;" class="link-underline-opacity-100-hover">
                            disini!
                        </a>
                      </div>
                    </div>
                    <div class="px-4">
                      <button class="w-100 btn btn-lg d-flex text-white justify-content-center fw-bold" style="background-color: #E5BC37" type="submit">Login</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

