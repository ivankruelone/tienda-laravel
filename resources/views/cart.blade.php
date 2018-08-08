@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="text-muted">Empty your cart <a href="{{ route('cart.empty') }}"> <i class="fas fa-cart-arrow-down"></i></a></span>
            <span class="badge badge-secondary badge-pill">@php echo Cart::count(); @endphp </span>
          </h4>
          <ul class="list-group mb-3">
          	@foreach(Cart::content() as $row)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div class="row">
              	<div class="col-md-3">
					<div class="card mb-6 box-shadow">
						<img class="card-img-top" src="{{ '../images/' . $row->options->image }}" alt="{{ $row->name }}">
					</div>
				</div>
				<div class="col-md-9">
	                <h6 class="my-0"> Quantity: {{$row->qty}} </h6>
	                <small class="text-muted">{{$row->name}}</small>
	                <p>
	                	<a href="{{route('cart.remove', $row->rowId)}}"> <i class="fas fa-trash-alt"></i> </a>
	                	<a href="{{route('cart.minus', ['rowId' => $row->rowId, 'qty' => $row->qty])}}"> <i class="fas fa-minus"></i> </a>
	                	<a href="{{route('cart.plus', ['rowId' => $row->rowId, 'qty' => $row->qty])}}"> <i class="fas fa-plus"></i> </a>
	                </p>
                </div>
              </div>
              <span class="text-muted">{{$row->price}}</span>
            </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
              <span>SubTotal</span>
              <strong>{{Cart::subtotal()}}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Tax (21%)</span>
              <strong>{{Cart::tax()}}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>{{Cart::total()}}</strong>
            </li>
          </ul>

          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form>
        </div>

        <div class="col-md-6 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form class="needs-validation" action="{{url('orders')}}" method="POST">
          	@csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ isset($ship->firstname) ? $ship->firstname : '' }}" placeholder="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value="{{ isset($ship->lastname) ? $ship->lastname : '' }}" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ isset($ship->email) ? $ship->email : '' }}" placeholder="you@example.com" required>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address1">Address</label>
              <input type="text" class="form-control" id="address1" name="address1" value="{{ isset($ship->address1) ? $ship->address1 : '' }}" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" name="address2" value="{{ isset($ship->address2) ? $ship->address2 : '' }}" placeholder="Apartment or suite" required>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="country" name="country" required>
                  <option value="">Choose...</option>
                  <option>United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" id="state" name="state" required>
                  <option value="">Choose...</option>
                  <option>California</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zip" value="{{ isset($ship->zip) ? $ship->zip : '' }}" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="saveInfo" name="saveInfo">
              <label class="custom-control-label" for="saveInfo">Save this information for next time</label>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-cvv">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
          </form>
        </div>
    </div>

</div>
@endsection