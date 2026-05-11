<x-filament-widgets::widget>
    <x-filament::section heading="Khách hàng chi tiêu nhiều nhất">
        <div style="overflow-x: auto;">
            <table style="width: 100%; font-size: 13px; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(107,114,128,0.2);">
                        <th style="text-align: left; padding: 6px 8px; font-weight: 500; color: #9ca3af;">Khách hàng</th>
                        <th style="text-align: center; padding: 6px 8px; font-weight: 500; color: #9ca3af;">Số đơn</th>
                        <th style="text-align: right; padding: 6px 8px; font-weight: 500; color: #9ca3af;">Tổng chi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr style="border-bottom: 1px solid rgba(107,114,128,0.1);">
                            <td style="padding: 6px 8px;">
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <span>👤</span>
                                    <div>
                                        <p style="font-weight: 500; font-size: 12px;">{{ $customer->name ?? 'N/A' }}</p>
                                        <p style="font-size: 11px; color: #6b7280;">{{ $customer->phone ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 6px 8px; text-align: center;">
                                <span style="display: inline-block; padding: 1px 8px; border-radius: 9999px; font-size: 11px; font-weight: 500; background: rgba(59,130,246,0.1); color: #60a5fa;">{{ $customer->total_orders }}</span>
                            </td>
                            <td style="padding: 6px 8px; text-align: right; font-weight: 600; color: #4ade80; font-size: 12px;">
                                {{ number_format($customer->total_spent, 0, ',', '.') }}đ
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="padding: 12px; text-align: center; color: #6b7280; font-size: 13px;">Chưa có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
