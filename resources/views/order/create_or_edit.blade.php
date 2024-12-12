
@extends('layouts.form')

@section('content')

  <livewire:order-form :products="$products" :order="$order ?? null" />

@endsection

