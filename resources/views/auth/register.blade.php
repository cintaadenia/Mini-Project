@extends('layouts.app')

@section('content')
<div class="info-container">
    <div class="info-item">
      <p>Register as:</p>
      <div class="btn register-pasien">Pasien</div>
      <div class="btn register-dokter">Dokter</div>
    </div>
  </div>
  
  <div class="form-container form-pasien" style="display: none;">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <input type="hidden" name="role" value="pasien">
      <input name="name" placeholder="Name" type="text" required>
      <input name="email" placeholder="Email Address" type="email" required>
      <input name="password" placeholder="Password" type="password" required>
      <input name="password_confirmation" placeholder="Confirm Password" type="password" required>
      <button type="submit" class="btn btn-primary">Register as Pasien</button>
    </form>
  </div>
  
  <div class="form-container form-dokter" style="display: none;">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <input type="hidden" name="role" value="dokter">
      <input name="name" placeholder="Name" type="text" required>
      <input name="email" placeholder="Email Address" type="email" required>
      <input name="password" placeholder="Password" type="password" required>
      <input name="password_confirmation" placeholder="Confirm Password" type="password" required>
      <input name="specialization" placeholder="Specialization" type="text" required>
      <button type="submit" class="btn btn-primary">Register as Dokter</button>
    </form>
  </div>
  @endsection
