<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        * {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        body {
            font-family: 'Poppins', sans-serif;
            width: 860px;
            background: #ffffff;
            height: fit-content !important;
        }
    </style>
</head>

<body class="bg-white text-gray-900">
    <div class="px-14 py-12">

        {{-- Header --}}
        <div class="flex justify-between items-start pb-5 border-b border-gray-200 mb-8">
            <div>
                <div class="text-4xl font-extrabold text-blue-600 tracking-tight">INVOICE</div>
                <div class="text-sm text-gray-500 mt-1 font-medium">{{ $invoiceNumber }}</div>
            </div>
            <div class="text-right">
                <div class="text-xl font-bold text-gray-900">LF Store</div>
                <div class="text-xs text-gray-500 mt-1 leading-5">
                    Jl Indrakila RT 3 no 3 kel Gn. Samarinda, baru, Kec. Balikpapan Utara<br>
                    Kota Balikpapan, Kalimantan Timur 76128<br>
                    Telp: 0896-5071-0460
                </div>
            </div>
        </div>

        {{-- Bill To + Payment Info --}}
        <div class="flex justify-between items-start mb-8">
            <div>
                <div class="text-xs font-semibold text-blue-600 uppercase mb-2" style="letter-spacing: 0.08em;">
                    Nama Pembeli:
                </div>
                <div class="text-lg font-bold text-gray-900">{{ $customer }}</div>
            </div>
            <div class="text-right">
                <div class="text-xs font-semibold text-blue-600 uppercase mb-2" style="letter-spacing: 0.08em;">
                    Informasi Pembayaran:
                </div>
                <div class="text-sm text-gray-600 leading-6">
                    <span class="font-medium">Tanggal:</span>
                    <span class="font-bold text-gray-900">
                        {{ \Carbon\Carbon::parse($date)->format('d F Y') }}
                    </span><br>
                    <span class="font-medium">Metode:</span>
                    <span class="font-bold text-gray-900">
                        {{ $paymentMethod === 'transfer' ? 'Transfer' : 'COD' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Items Table --}}
        <table class="w-full border-collapse mb-0">
            <thead>
                <tr class="bg-gray-100">
                    <th class="text-left text-xs font-semibold text-gray-600 py-3 px-4" style="width: 45%">
                        Deskripsi Produk
                    </th>
                    <th class="text-right text-xs font-semibold text-gray-600 py-3 px-4" style="width: 20%">Harga</th>
                    <th class="text-center text-xs font-semibold text-gray-600 py-3 px-4" style="width: 10%">Qty</th>
                    <th class="text-right text-xs font-semibold text-gray-600 py-3 px-4" style="width: 25%">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr class="border-b border-gray-100">
                        <td class="py-4 px-4 text-sm font-semibold text-gray-900 align-top">{{ $item['name'] }}</td>
                        <td class="py-4 px-4 text-sm text-gray-600 text-right align-top">
                            Rp{{ number_format($item['price'], 0, ',', '.') }}
                        </td>
                        <td class="py-4 px-4 text-sm font-bold text-gray-900 text-center align-top">
                            {{ (int)$item['qty'] }}
                        </td>
                        <td class="py-4 px-4 text-sm font-bold text-gray-900 text-right align-top">
                            Rp{{ number_format($item['subtotal'], 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Subtotal + Ongkir + Diskon --}}
        <div class="border-t border-gray-200 pt-4 mt-2">

            {{-- Subtotal --}}
            <div class="flex justify-between items-center py-2">
                <span class="text-sm text-gray-500 font-medium">Subtotal</span>
                <span class="text-sm font-semibold text-gray-700">
                    Rp{{ number_format(collect($items)->sum('subtotal'), 0, ',', '.') }}
                </span>
            </div>

            {{-- Ongkir --}}
            @if(isset($shippingCost) && $shippingCost > 0)
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-500 font-medium">Ongkos Kirim</span>
                    <span class="text-sm font-semibold text-gray-700">
                        Rp{{ number_format($shippingCost, 0, ',', '.') }}
                    </span>
                </div>
            @endif

            {{-- Diskon --}}
            @if(isset($discountNominal) && $discountNominal > 0)
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-500 font-medium">
                        Diskon{{ isset($discountName) && $discountName ? ' (' . $discountName . ')' : '' }}
                    </span>
                    <span class="text-sm font-semibold text-red-500">
                        - Rp{{ number_format($discountNominal, 0, ',', '.') }}
                    </span>
                </div>
            @endif

        </div>

        {{-- Total Akhir --}}
        <div class="border-t border-gray-200 pt-5 mt-2 flex justify-between items-baseline">
            <span class="text-2xl font-extrabold text-gray-900">Total Akhir</span>
            <span class="text-4xl font-extrabold text-blue-600">
                Rp{{ number_format($total, 0, ',', '.') }}
            </span>
        </div>

        {{-- Footer --}}
        <div class="border-t border-gray-200 mt-6 pt-4 text-center text-xs text-gray-400 font-medium">
            Terima kasih atas pesanan Anda. Jika ada pertanyaan, silakan hubungi kami.
        </div>

    </div>
</body>

</html>