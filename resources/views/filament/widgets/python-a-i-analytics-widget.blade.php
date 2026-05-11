<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            ⚡ Python AI: Phân tích hành vi mua sắm
        </x-slot>

        @if($analyticsData)
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                {{-- Phân tích theo Giới tính --}}
                <div style="padding: 12px; background: rgba(59,130,246,0.05); border-radius: 8px; border: 1px solid rgba(59,130,246,0.15);">
                    <p style="font-weight: 600; font-size: 13px; margin-bottom: 8px; color: #93c5fd; border-bottom: 1px solid rgba(59,130,246,0.15); padding-bottom: 6px;">👥 Sở thích theo Giới tính</p>
                    @if(isset($analyticsData['gender_insights']) && count($analyticsData['gender_insights']) > 0)
                        @foreach($analyticsData['gender_insights'] as $gender => $insight)
                            <div style="display: flex; align-items: center; gap: 8px; padding: 4px 0; font-size: 13px;">
                                <span style="font-weight: 500; min-width: 50px;">{{ $gender == 'male' ? '👨 Nam' : ($gender == 'female' ? '👩 Nữ' : '🧑 Khác') }}</span>
                                <span style="color: #9ca3af;">→</span>
                                <span style="color: #4ade80; font-weight: 600;">{{ $insight['top_category'] }}</span>
                            </div>
                        @endforeach
                    @else
                        <p style="font-size: 12px; color: #6b7280;">Chưa đủ dữ liệu.</p>
                    @endif
                </div>

                {{-- Phân tích theo Độ tuổi --}}
                <div style="padding: 12px; background: rgba(168,85,247,0.05); border-radius: 8px; border: 1px solid rgba(168,85,247,0.15);">
                    <p style="font-weight: 600; font-size: 13px; margin-bottom: 8px; color: #c4b5fd; border-bottom: 1px solid rgba(168,85,247,0.15); padding-bottom: 6px;">📊 Sở thích theo Độ tuổi</p>
                    @if(isset($analyticsData['age_insights']) && count($analyticsData['age_insights']) > 0)
                        @foreach($analyticsData['age_insights'] as $age => $insight)
                            <div style="display: flex; align-items: center; gap: 8px; padding: 4px 0; font-size: 13px;">
                                <span style="font-weight: 500; min-width: 70px;">🎂 {{ $age == 'Unknown' ? 'Chưa rõ' : $age }}</span>
                                <span style="color: #9ca3af;">→</span>
                                <span style="color: #4ade80; font-weight: 600;">{{ $insight['top_category'] }}</span>
                            </div>
                        @endforeach
                    @else
                        <p style="font-size: 12px; color: #6b7280;">Chưa đủ dữ liệu.</p>
                    @endif
                </div>
            </div>
            <p style="font-size: 11px; color: #6b7280; text-align: right; margin-top: 8px;">Đã phân tích: {{ $analyticsData['total_analyzed_orders'] ?? 0 }} đơn hàng</p>
        @else
            <div style="text-align: center; padding: 16px; color: #6b7280; font-size: 13px;">
                ⚠️ Chưa có dữ liệu mua hàng để phân tích.
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
