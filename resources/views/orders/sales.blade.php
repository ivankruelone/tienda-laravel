@extends('layouts.app')

@section('content')

<div class="container">

	<h3>Total sales</h3>

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th class="text-right">Subtotal</th>
				<th class="text-right">Tax</th>
				<th class="text-right">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-right">{{ number_format($sales->subtotal, 2) }}</td>
				<td class="text-right">{{ number_format($sales->tax, 2) }}</td>
				<td class="text-right">{{ number_format($sales->total, 2) }}</td>
			</tr>
		</tbody>
	</table>
	
	<h3>Today sales</h3>

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th class="text-right">Subtotal</th>
				<th class="text-right">Tax</th>
				<th class="text-right">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-right">{{ number_format($todaySales->subtotal, 2) }}</td>
				<td class="text-right">{{ number_format($todaySales->tax, 2) }}</td>
				<td class="text-right">{{ number_format($todaySales->total, 2) }}</td>
			</tr>
		</tbody>
	</table>

	<h3>Last week sales</h3>

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th class="text-right">Subtotal</th>
				<th class="text-right">Tax</th>
				<th class="text-right">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-right">{{ number_format($lastWeekSales->subtotal, 2) }}</td>
				<td class="text-right">{{ number_format($lastWeekSales->tax, 2) }}</td>
				<td class="text-right">{{ number_format($lastWeekSales->total, 2) }}</td>
			</tr>
		</tbody>
	</table>

	<h3>Last month sales</h3>

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th class="text-right">Subtotal</th>
				<th class="text-right">Tax</th>
				<th class="text-right">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-right">{{ number_format($lastMonthSales->subtotal, 2) }}</td>
				<td class="text-right">{{ number_format($lastMonthSales->tax, 2) }}</td>
				<td class="text-right">{{ number_format($lastMonthSales->total, 2) }}</td>
			</tr>
		</tbody>
	</table>

	<h3>Last year sales</h3>

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th class="text-right">Subtotal</th>
				<th class="text-right">Tax</th>
				<th class="text-right">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-right">{{ number_format($lastYearSales->subtotal, 2) }}</td>
				<td class="text-right">{{ number_format($lastYearSales->tax, 2) }}</td>
				<td class="text-right">{{ number_format($lastYearSales->total, 2) }}</td>
			</tr>
		</tbody>
	</table>

</div>


@endsection