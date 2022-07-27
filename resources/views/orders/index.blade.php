<button>
    <a href="{{ route('foods.index') }}">Foods</a>
</button>

Add New Order:
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    @method('POST')
    <select name="food">
        @foreach ($foods as $food)
            <option value="{{ $food->id }}">{{ $food->name }}</option>
        @endforeach
    </select>
    <input type="text" name="name" placeholder="Name">
    <input type="number" name="quantity" placeholder="Quantity">
    <button type="submit">Create</button>
</form>

@forelse ($orders as $order)
    <div>
        <div>No.:{{ $order->id }}</div>
        <div>Name: {{ $order->name }}</div>
        <div>Food Name: {{ $order->food->name }}</div>
        <div>Food Price: {{ $order->food->price }}</div>
        <div>Quantity:{{ $order->quantity }}</div>
        <div>Total Price {{ $order->food->price * $order->quantity }}</div>
        <form action="{{ route('orders.update', $order) }}" method="post">
            @csrf
            @method('PUT')
            <input type="checkbox" name="is_paid" value="{{ $order->is_paid }}"
                {{ $order->is_paid ? 'checked' : '' }}>
            <button type="submit">Update</button>
            <form action="{{ route('orders.destroy', $order) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">X</button>
            </form>
    </div>
    </div>
    <hr>
@empty
    <div>No orders</div>
@endforelse
