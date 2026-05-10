<x-filament-widgets::widget>
    <x-filament::section heading="Khách hàng chi tiêu nhiều nhất">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left py-2 px-3 font-medium text-gray-500 dark:text-gray-400">Khách hàng</th>
                        <th class="text-center py-2 px-3 font-medium text-gray-500 dark:text-gray-400">Số đơn</th>
                        <th class="text-right py-2 px-3 font-medium text-gray-500 dark:text-gray-400">Tổng chi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="py-2.5 px-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white text-xs">{{ $customer->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $customer->phone ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2.5 px-3 text-center">
                                <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">{{ $customer->total_orders }}</span>
                            </td>
                            <td class="py-2.5 px-3 text-right font-semibold text-green-600 dark:text-green-400 text-xs">
                                {{ number_format($customer->total_spent, 0, ',', '.') }}đ
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-gray-500 dark:text-gray-400 text-sm">Chưa có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
