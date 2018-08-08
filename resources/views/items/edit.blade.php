@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row">
		<div class="col-sm">
			<form method="post" action="{{ url('/items', $item->id) }}" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="_method" value="PATCH">
				<div class="form-group">
					<label for="sku">SKU</label>
					<input type="text" class="form-control" name="sku" id="sku" placeholder="SKU" value="{{$item->sku}}">
				</div>
				<div class="form-group">
					<label for="gender_id">Gender</label>
					<select class="form-control" id="gender_id" name="gender_id">
						@foreach($genders as $gender)
						<option value="{{ $gender->id }}" @if($item->gender_id == $gender->id) selected @endif>{{ $gender->gender }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="category_id">Category</label>
					<select class="form-control" id="category_id" name="category_id">
						@foreach($categories as $category)
						<option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>{{ $category->category }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{$item->description}}">
				</div>
				<div class="form-group">
					<label for="slug">Slug</label>
					<textarea class="form-control" id="slug" name="slug" rows="3">{{$item->slug}}</textarea>
				</div>
				<div class="form-group">
					<label for="cost">Cost</label>
					<input type="number" class="form-control" name="cost" id="cost" placeholder="Cost" step="0.01" min="0" value="{{$item->cost}}">
				</div>
				<div class="form-group">
					<label for="price">Price</label>
					<input type="number" class="form-control" name="price" id="price" placeholder="Price" step="0.01" min="0" value="{{$item->price}}">
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" name="image">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>


</div>
@endsection
