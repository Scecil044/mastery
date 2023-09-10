<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-green-800 text-white py-2 px-3 hover:bg-green-700 shadow-md transition-colors active:bg-green-600']) }}>
    {{ $slot }}
</button>
