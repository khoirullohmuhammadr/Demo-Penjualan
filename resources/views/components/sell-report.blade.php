<table class="table table-primary table-hover border-info">
  <tr class="table-secondary">
    <th scope="col">#</th>
    <th scope="col">Product</th>
    <th scope="col">Sales</th>
    <th scope="col">Product Sells</th>
    <th scope="col">Input Date</th>
    
  </tr>
  <ol class="list-group-numbered">
  @foreach ($sell as $x)
  <tr>
    <th>{{ $x->id }}</th>
    <td>{{ $x->product->product_name }}</td>
    <td>{{ $x->user->name }}</td>
    <td>{{ $x->sell }}</td> 
    <td>{{ $x->created_at }}</td> 

  </tr>

  <!-- Detail popup untuk setiap user -->

  @endforeach
  </ol>
</table>