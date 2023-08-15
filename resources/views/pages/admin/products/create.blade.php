@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
                <h4 class="text-dark fw-semibold">Buat Produk Baru</h4>
                <a href="{{ route('produk.index') }}" class="btn btn-success d-flex align-items-center gap-2">
                    <i class="bx bx-arrow-back"></i> Cancel & Return
                </a>
            </div>

            <div class="card border-0">
                <div class="card-body">
                    <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category_id">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="code_id">Select Code</label>
                                    <select name="code_id" id="code_id" class="form-control" required>
                                        @foreach ($codes as $code)
                                            <option value="{{ $code->id }}">{{ $code->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name">Name Product</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" id="stock" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="image">Image</label>
                                    <input type="file" accept="image/*" name="image" id="image"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description">Descripsion</label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <button  class="btn btn-success " type="submit" > <i class='bx bx-save me-2'></i>Save New</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
