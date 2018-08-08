@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row">
		<div class="col-sm text-right">
			<a href="{{ action('ItemController@create') }}"  class="btn btn-primary"> <i class="fas fa-plus"></i> Add new item </a>
		</div>
	</div>

    @include('partials.items')

</div>
@endsection
