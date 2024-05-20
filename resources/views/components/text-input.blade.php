@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-700 bg-d-rgba text-gray-300 focus:border-red-500 focus:ring-j-rgba rounded-md shadow-sm']) !!}>
