<x-filament-widgets::widget>
    <x-filament::section>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- Top sản phẩm bán chạy --}}
            <div>
                <h3 class="mb-3 text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    🏆 Sản phẩm bán chạy nhất
                </h3>
                <div class="space-y-2">
                    @forelse($topProducts as $index => $product)
                        <div class="flex items-center justify-between rounded-lg bg-gray-50 dark:bg-gray-800 px-3 py-2">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold w-5 text-gray-400">#{{ $index + 1 }}</span>
                                <span class="text-sm text-gray-800 dark:text-gray-200 truncate max-w-[160px]" title="{{ $product->name }}">{{ $product->name }}</span>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-green-100 dark:bg-green-900 px-2 py-0.5 text-xs font-medium text-green-800 dark:text-green-200">
                                {{ number_format($product->total_sold) }} đã bán
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic">Chưa có dữ liệu bán hàng.</p>
                    @endforelse
                </div>
            </div>

            {{-- Khách hàng VIP --}}
            <div>
                <h3 class="mb-3 text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    👑 Khách hàng chi tiêu nhiều nhất
                </h3>
                <div class="space-y-2">
                    @forelse($topCustomers as $index => $customer)
                        <div class="flex items-center justify-between rounded-lg bg-gray-50 dark:bg-gray-800 px-3 py-2">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold w-5 text-gray-400">#{{ $index + 1 }}</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate max-w-[140px]">{{ $customer->name ?? 'Khách vãng lai' }}</p>
                                    <p class="text-xs text-gray-400">{{ $customer->total_orders }} đơn hàng</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-amber-100 dark:bg-amber-900 px-2 py-0.5 text-xs font-medium text-amber-800 dark:text-amber-200">
                                {{ number_format($customer->total_spent) }}₫
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic">Chưa có dữ liệu.</p>
                    @endforelse
                </div>
            </div>

            {{-- Sản phẩm ế --}}
            <div>
                <h3 class="mb-3 text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    ⚠️ Sản phẩm ế (ít mua nhất)
                </h3>
                <div class="space-y-2">
                    @forelse($leastSoldProducts as $index => $product)
                        <div class="flex items-center justify-between rounded-lg bg-gray-50 dark:bg-gray-800 px-3 py-2">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold w-5 text-gray-400">#{{ $index + 1 }}</span>
                                <span class="text-sm text-gray-800 dark:text-gray-200 truncate max-w-[160px]" title="{{ $product->name }}">{{ $product->name }}</span>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-red-100 dark:bg-red-900 px-2 py-0.5 text-xs font-medium text-red-800 dark:text-red-200">
                                {{ number_format($product->total_sold) }} đã bán
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic">Chưa có dữ liệu.</p>
                    @endforelse
                </div>
            </div>

            {{-- Sản phẩm ít lượt xem --}}
            <div>
                <h3 class="mb-3 text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    👁️ Sản phẩm ít được quan tâm
                </h3>
                <div class="space-y-2">
                    @forelse($leastViewedProducts as $index => $product)
                        <div class="flex items-center justify-between rounded-lg bg-gray-50 dark:bg-gray-800 px-3 py-2">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold w-5 text-gray-400">#{{ $index + 1 }}</span>
                                <span class="text-sm text-gray-800 dark:text-gray-200 truncate max-w-[160px]" title="{{ $product->name }}">{{ $product->name }}</span>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-orange-100 dark:bg-orange-900 px-2 py-0.5 text-xs font-medium text-orange-800 dark:text-orange-200">
                                {{ number_format($product->view) }} lượt xem
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic">Chưa có dữ liệu.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
