<table class="table table-primary table-hover">
  <tr class="table-secondary">
    <th scope="col"></th>
    <th scope="col">Product</th>
    <th scope="col">Stok</th>
    <th scope="col">Input Date</th>
    <!-- <th scope="col">Action</th> -->
  </tr>
  <ol class="list-group-numbered">
  @foreach ($stok as $x)
  <tr>
    <th class="list-group-numbered"></th>
    <td>{{ $x->product->product_name }}</td> 
    <td>{{ $x->stok }}</td>
    <td>{{ $x->input_date }}</td>
  </tr>

  @endforeach
  </ol>
</table>


