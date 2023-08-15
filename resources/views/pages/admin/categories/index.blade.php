@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
                <h4 class="text-dark fw-semibold">Product Category</h4>
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal"
                    class="btn btn-success d-flex align-items-center gap-2">
                    <i class="bx bx-plus"></i> Add Category
                </button>
            </div>

            <div class="card border-0">
                <div class="card-body">
                    @if ($items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fs-7 text-uppercase">no</th>
                                        <th class="fs-7 text-uppercase">name category</th>
                                        <th class="fs-7 text-uppercase">jumlah produk</th>
                                        <th class="fs-7 text-uppercase"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ number_format($item->products->count()) }} Produk</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-end gap-2">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#addModal{{ $item->id }}"
                                                        class="btn btn-sm btn-success text-white d-flex align-items-center gap-2">
                                                        <i class='bx bx-edit'></i>
                                                    </button>
                                                    <form action="{{ route('kategori.destroy', $item->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm d-flex align-items-center gap-2"
                                                            onclick="return confirm('Kamu yakin untuk menghapus kategori ini? datanya bisa kehapus semua loh')">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="addModal{{ $item->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">Edit Category {{ $item->name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('kategori.update', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name">Name Category</label>
                                                                <input type="text" name="name" id="name"
                                                                    value="{{ $item->name }}" class="form-control"
                                                                    required>
                                                            </div>
                                                            <button class="btn btn-success px-4" type="submit">
                                                                Save New
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mb-0 text-danger text-center">There are no categories yet</p>
                    @endif
                </div>
            </div>
    </section>

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add new Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name Categori</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <button class="btn btn-success px-4" type="submit">
                            Save New
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
