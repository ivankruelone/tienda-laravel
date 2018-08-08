<div class="album py-5 bg-light">
	<div class="container">
		<div class="row">
			@foreach($items as $item)
			<div class="col-md-3">
				<div class="card mb-3 box-shadow">
					<img class="card-img-top" src="{{ '../images/' . $item->image }}" alt="{{ $item->description }}">
					<div class="card-body">
						<h3>{{ $item->description }}</h3>
						<p class="card-text">{{ $item->slug }}</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="btn-group">
								@guest
								<a class="btn btn-sm btn-outline-primary" href="{{ action('ItemController@show', $item->id) }}"> View </a>
								<a class="btn btn-sm btn btn-success" href="{{ route('cart.add', $item->id) }}"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
								@else
									<a class="btn btn-sm btn-outline-primary" href="{{ action('ItemController@show', $item->id) }}"> View </a>
									@if(Auth::user()->role == 'admin')
									<a class="btn btn-sm btn-outline-secondary" href="{{ action('ItemController@edit', $item->id) }}"> Edit </a>
										@if($item->deleted_at == null)
										<form action="{{action('ItemController@destroy', $item->id)}}" method="post">
											@csrf
											<input name="_method" type="hidden" value="DELETE">
											<button class="btn btn-sm btn-outline-danger" type="submit"> Delete </button>
										</form>
										@else
										<a class="btn btn-sm btn-outline-success" href="{{ route('items.restore', $item->id) }}"> Restore </a>
										@endif
									@else
										<a class="btn btn-sm btn btn-success" href="{{ route('cart.add', $item->id) }}"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
									@endif

								@endguest
							</div>
							<small class="text-muted">$ {{ number_format($item->price, 2) }}</small>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>