<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Python AI: Phân tích hành vi mua sắm</h2>
        </div>

        @if($analyticsData)
            <div class="flex flex-col gap-4">
                <!-- Phân tích theo Giới tính -->
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-3 border-b border-gray-200 dark:border-gray-700 pb-2">Sở thích theo Giới tính</h3>
                    @if(isset($analyticsData['gender_insights']) && count($analyticsData['gender_insights']) > 0)
                        <ul class="space-y-3">
                            @foreach($analyticsData['gender_insights'] as $gender => $insight)
                                <li class="flex items-start gap-3">
                                    <div class="p-2 rounded-md bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                        @if($gender === 'male')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        @elseif($gender === 'female')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $gender == 'male' ? 'Nam' : ($gender == 'female' ? 'Nữ' : 'Chưa rõ') }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Mua nhiều nhất: <strong class="text-green-600 dark:text-green-400">{{ $insight['top_category'] }}</strong></p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500">Chưa đủ dữ liệu.</p>
                    @endif
                </div>

                <!-- Phân tích theo Độ tuổi -->
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-3 border-b border-gray-200 dark:border-gray-700 pb-2">Sở thích theo Độ tuổi</h3>
                    @if(isset($analyticsData['age_insights']) && count($analyticsData['age_insights']) > 0)
                        <ul class="space-y-3">
                            @foreach($analyticsData['age_insights'] as $age => $insight)
                                <li class="flex items-start gap-3">
                                    <div class="p-2 rounded-md bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $age == 'Unknown' ? 'Chưa rõ' : $age . ' tuổi' }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Yêu thích: <strong class="text-green-600 dark:text-green-400">{{ $insight['top_category'] }}</strong></p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500">Chưa đủ dữ liệu.</p>
                    @endif
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-4 text-right">Tổng số đơn hàng đã phân tích: {{ $analyticsData['total_analyzed_orders'] ?? 0 }}</p>
        @else
            <div class="flex flex-col items-center justify-center py-6 text-gray-500">
                <svg class="w-12 h-12 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <p>Python script chưa chạy được hoặc chưa có dữ liệu mua hàng.</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
