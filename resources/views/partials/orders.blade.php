	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th>ID</th>
				<th class="text-right">Subtotal</th>
				<th class="text-right">Tax</th>
				<th class="text-right">Total</th>
				<th class="text-center">Status</th>
				<th>Created</th>
				<th>Updated</th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $order)
			<tr>
				<td>{{ $order->id }}</td>
				<td class="text-right">{{ number_format($order->subtotal, 2) }}</td>
				<td class="text-right">{{ number_format($order->tax, 2) }}</td>
				<td class="text-right">{{ number_format($order->total, 2) }}</td>
				<td class="text-center @if($order->status == 'SENT') bg-success @else bg-warning @endif ">{{ $order->status }}</td>
				<td>{{ $order->created_at }}</td>
				<td>{{ $order->updated_at }}</td>
			</tr>
			<tr>
				<td colspan="2">Detail:</td>
				<td colspan="5">
					<table class="table">
						<thead>
							<tr>
								<th>Quantity</th>
								<th>Description</th>
								<th>Price</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							@foreach($order->details as $detail)
							<tr>
								<td>{{ $detail->qty }}</td>
								<td>{{ $detail->item->description }}</td>
								<td class="text-right">{{ $detail->order_price }}</td>
								<td class="text-right">{{ $detail->order_price * $detail->qty }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">Ship to:</td>
				<td colspan="4" class="text-center">
					<table class="table">
						<thead>
							<tr>
								<th>{{ $order->destination->firstname . ' ' . $order->destination->lastname }} <br /> {{ $order->destination->address1 }} <br /> {{ $order->destination->address2 }} <br /> {{ $order->destination->state . ' ' . $order->destination->zip }} <br /> {{ $order->destination->country }}</th>
							</tr>
						</thead>
					</table>
				</td>
				<td class="text-center">
					@if(Auth::user()->role == 'admin' && $order->status == 'PENDING')
					<a href="{{ route('order.send', $order->id) }}" class="btn btn-primary"> Items has been sent. </a>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
