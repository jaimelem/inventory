@extends('base_layout')
@section('content')
@section('page-name') Productos @endsection
<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4 mt-3">
    <a class="btn btn-primary me-md-2" href="{{ url('product') }}" type="button">Registrar</a>
  </div>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Registrado por: </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{-- <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011-04-25</td>
            <td>action buttons</td>
        </tr> --}}
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->user_name }}</td>
                <td>
                    <div class="d-inline p-2">
                        <a href="{{url('see-product/'.$product->id)}}">Ver</a>
                    </div>
                    <div class="d-inline p-2">
                        <a href="{{url('product/'.$product->id)}}">Editar</a>
                    </div>
                    <div class="d-inline p-2">
                        <a href="#" onclick="delete_product({{ $product->id }})">Eliminar</a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Producto</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Registrado por: </th>
            <th></th>
        </tr>
    </tfoot>
</table>
@endsection
@section('scripts')
<script>
    new DataTable('#example');

    function delete_product(id){
        $.ajax({
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `delete-product/${id}`,
            success: (data) => {
                location.reload();
            },
            error: (err) => {
                console.log(err);
            }
        });
    }
</script>
@endsection
