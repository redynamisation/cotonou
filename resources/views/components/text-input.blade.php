@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-slate-300 focus:border-orange-300 focus:ring-orange-300 rounded-md shadow-sm']) }}>
