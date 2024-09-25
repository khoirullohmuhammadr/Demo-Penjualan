<table class="table table-primary table-hover">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Product</th>
            <th scope="col">Stok Before</th>
            <th scope="col">Stok Added</th>
            <th scope="col">Current Stok</th>
            <th scope="col">Input Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stok as $x)
            @php
               
                $stokBefore = $stok->where('products_id', $x->products_id)
                                    ->where('created_at', '<', $x->created_at)
                                    ->sum('stok');
                
               
                $currentStock = $stokBefore + $x->stok;
            @endphp
            <tr>
                <td>{{ $x->product->product_name }}</td> 
                <td>{{ $stokBefore }}</td> 
                <td>{{ $x->stok }}</td> 
                <td>{{ $currentStock }}</td> 
                <td>{{ $x->created_at->format('Y-m-d') }}</td> 
            </tr>
        @endforeach
    </tbody>
</table>



<style>
  table{
    border:1px solid;
  }
</style>
    
    <!-- @foreach ($stok as $x)
    <tr>
      <th class="list-group-numbered"></th>
      <td>{{ $x->product->product_name }}</td> 
      <td>{{ $x->stok }}</td>
    </tr>
    @endforeach -->