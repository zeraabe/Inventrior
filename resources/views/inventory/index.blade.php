@extends('layouts.app')

@section('title', 'Inventory Dashboard')

@section('header', 'Inventory Dashboard')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a></li>
    <li class="text-gray-500">Inventory</li>
@endsection

@section('content')
    <x-pages.inventory.index :summary="$summary" 
                             :lowStockItems="$lowStockItems" 
                             :outOfStockItems="$outOfStockItems"
                             :recentMovements="$recentMovements"
                             :totalValue="$totalValue" />
@endsection