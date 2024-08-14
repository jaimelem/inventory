@extends('base_layout')
@section('content')
@section('page-name') Producto @endsection
@if(isset($product))
    @php $url = "update-product"; $button = "Actualizar"; @endphp
@else @php $url = "create-product"; $button = "Registrar"; @endphp
@endif
@if($errors->any())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<form action="{{ url($url) }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
      <label for="product" class="form-label">Producto</label>
      <input type="text" class="form-control d-none" name="product_id" id="product_id">
      <input type="text" class="form-control" name="product" id="product">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Descripción</label>
      <input type="text" class="form-control" name="description" id="description">
    </div>
    <div class="row g-2 mb-3">
        <div class="col-auto">
            <label for="quantity" class="form-label">Cantidad</label>
            <input type="number" class="form-control" name="quantity" id="quantity">
        </div>
        <div class="col-auto">
            <label for="price" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price">
        </div>
    </div>
    <button type="submit" id="action-btn" class="btn btn-primary">{{ $button }}</button>
  </form>

  @endsection
  @section('scripts')
    <script>
        @isset($product)
            let product = @json($product);
            $('#product_id').val(product.id);
            $('#product').val(product.name);
            $('#description').val(product.description);
            $('#quantity').val(product.quantity);
            $('#price').val(product.price);
        @endisset

        @isset($route)
            let route = @json($route);
            let uri = route.uri.split('/')[0];

            if(uri === 'see-product'){
                $('#product_id').attr('disabled', 'disabled');
                $('#product').attr('disabled', 'disabled');
                $('#description').attr('disabled', 'disabled');
                $('#quantity').attr('disabled', 'disabled');
                $('#price').attr('disabled', 'disabled');
                $('#action-btn').addClass('d-none');
            }
        @endisset
    </script>
  @endsection
