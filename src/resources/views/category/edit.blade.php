@extends('layouts.master')
@push('css')
<link href="{{ url('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('components.breadcrumb', ['title' => 'Edit Kategori', 'lists' => ['Home' => '/', 'Kategori' => '/admin/category', 'Edit' => '#']])

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4>Edit Kategori</h4>
                        <p>Di bawah ini merupakan input untuk menyunting kategori.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Kategori</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                        <input type="text" name="name" id="name" placeholder="Nama kategori" required class="form-control @error('name') is-invalid @enderror" value="{{ $data->name }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Edit Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection