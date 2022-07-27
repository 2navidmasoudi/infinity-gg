<button>
    <a href="{{ route('orders.index') }}">Orders</a>
</button>

Add New Food:
<form action="{{ route('foods.store') }}" method="POST">
    @csrf
    @method('POST')
    <input type="text" name="name" placeholder="Name">
    <input type="number" name="price" placeholder="Price">
    <input type="number" name="quantity" placeholder="Quantity">
    <button type="submit">Create</button>
</form>

@forelse ($foods as $food)
    <div>
        <div>#{{ $food->id }}</div>
        <div>Name: {{ $food->name }}</div>
        <div>Price: {{ $food->price }}</div>
        <div>Quantity:{{ $food->quantity }}</div>
        <form action="{{ route('foods.destroy', $food) }}" method="post" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit">X</button>
        </form>
    </div>
    </div>
    <hr>
@empty
    <div>No foods</div>
@endforelse
