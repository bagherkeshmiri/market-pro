<div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 text-center p-4">

    {{-- آیکون --}}
    @if(Str::contains($paymentResultString, '✅'))
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-green-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z"/>
        </svg>
    @elseif(Str::contains($paymentResultString, '❌') || Str::contains($paymentResultString, '⚠️'))
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"/>
        </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0a9 9 0 0118 0z"/>
        </svg>
    @endif

    {{-- متن --}}
    <p class="text-base font-medium text-gray-800">
        {{ $paymentResultString }}
    </p>
</div>
