<x-filament::widget>
    <x-filament::card>
        <div class="text-lg font-bold">
            Low Stock Products (< 3)
        </div>
        <div class="mt-2 text-sm text-gray-500">
            <ul class="list-disc list-inside">
                @forelse ($data as $product)
                    <li>{{ $product->name }} (stok: {{ $product->stock }})</li>
                @empty
                    <li>Semua stok aman</li>
                @endforelse
            </ul>
        </div>
    </x-filament::card>
</x-filament::widget>
 