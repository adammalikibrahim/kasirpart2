@extends('layouts.app')

@section('content')
    <section class="collection-section" id="collection">
        <div class="container">

            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
                <h2 class="section-title mb-5">Kasir</h2>
                <a href="{{route('transaksi.create')}}" class="btn btn-success d-flex align-items-center gap-2">
                    <i class="bx bx-plus"></i> Add Product
                </a>
            </div>

            <div class="table-responsive mb-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase fs-7">#</th>
                            <th class="text-uppercase fs-7">nama produk</th>
                            <th class="text-uppercase fs-7">harga</th>
                            <th class="text-uppercase fs-7">quantity</th>
                            <th class="text-uppercase fs-7">sub-total</th>
                            <th class="text-uppercase fs-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                            @foreach ($transactions as $key => $item)
                                <tr style="vertical-align: middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->products->name}}</td>
                                    <td>{{ $item ->products->price }}</td>
                                    <td>{{ number_format($item->quantity) }}</td>
                                    <td>Rp.{{ number_format($item->quantity * $item->products->price) }}</td>

                                    <td>
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <form action="{{ route('transaksi.destroy', $item->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm d-flex align-items-center gap-2"
                                                    onclick="return confirm('Kamu yakin untuk menghapus produk ini? datanya bisa kehapus semua loh')">
                                                    <i class="bx bx-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                @php
                                    $total += $item->quantity * $item->products->price;
                                @endphp
                            @endforeach
                            <tr>
                                <td colspan="4">Total</td>
                                <th class="fs-5">
                                   Rp. {{ number_format($total) }}</th>
                                </tr>
                        {{-- @else --}}
                        {{-- @endif --}}
                    </tbody>
                </table>
            </div>
            <a href="" class="btn btn-success d-block mx-auto w-50 mt-5">Print</a>
        </div>
    </section>

@push('addon-style')
    <style>
        @media screen and (max-width: 768px) {
            .w-25 {
                width: 100% !important;
            }
        }
    </style>
@endpush

@push('addon-script')
    <script>
        function checkInput(number) {
            var inputNumber = parseInt(document.getElementById("quantity" + number).value);
            var btnUpdate = document.getElementById("btnUpdate" + number);
            var errorText = document.getElementById("errorText" + number);

            if (inputNumber > parseInt(document.getElementById("stock" + number).value)) {
                btnUpdate.disabled = true;
                errorText.textContent = "Input melebihi stok!";
            } else {
                btnUpdate.disabled = false;
                errorText.textContent = "";
            }
        }
    </script>
@endpush

@endsection
