@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="card mb-6 box-shadow">
				<img class="card-img-top" src="{{ '../images/' . $item->image }}" alt="{{ $item->description }}">
			</div>
		</div>

		<div class="col-md-6">
			<div class="card mb-6 box-shadow">
				<div class="card-body">
					<h3>{{ $item->description }}</h3>
					<p class="card-text">{{ $item->slug }}</p>
					<div class="d-flex justify-content-between align-items-center">
						<div class="btn-group">
							@guest
								<a class="btn btn-sm btn btn-success" href="{{ route('cart.add', $item->id) }}"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
							@else
								@if(Auth::user()->role == 'admin')
								<a class="btn btn-sm btn-outline-secondary" href="{{ action('ItemController@edit', $item->id) }}"> Edit </a>
									@if($item->deleted_at == null || $item->deleted_at = '')
									<form action="{{action('ItemController@destroy', $item->id)}}" method="post">
										@csrf
										<input name="_method" type="hidden" value="DELETE">
										<button class="btn btn-sm btn-outline-danger" type="submit"> Delete </button>
									</form>
									@else

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
	</div>
</div>

@endsection