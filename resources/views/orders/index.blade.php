<button>
    <a href="{{ route('foods.index') }}">Foods</a>
</button>

Add New Order:
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    @method('POST')
    <select name="food_id">
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
        <div>#{{ $order->id }} - {{ $order->is_paid ? 'Paid ✅' : 'Unpaid ❌' }} - {{ $order->created_at }}</div>
        <div>Name: {{ $order->name }}</div>
        <div>Food Name: {{ $order->food->name }}</div>
        <div>Food Price: {{ $order->food->price }}</div>
        <div>Quantity:{{ $order->quantity }}</div>
        <div>Total Price: {{ $order->food->price * $order->quantity }}</div>
        <div>Total Profit:
            @if ($order->is_paid)
                <span style="color: green">
                    {{ $order->food->price * $order->quantity - $order->food->pure_price * $order->quantity }}
                </span>
            @else
                <span style="color: red">
                    {{ $order->quantity * $order->food->pure_price * -1 }}
                </span>
            @endif
        </div>
        <form action="{{ route('orders.update', $order) }}" method="post" style="display: inline;">
            @csrf
            @method('PUT')
            <input type="hidden" name="is_paid" value="{{ $order->is_paid }}">
            <button type="submit">{{ !$order->is_paid ? '💰' : '💸' }}</button>
        </form>
        <form action="{{ route('orders.destroy', $order) }}" method="post" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit">🗑️</button>
        </form>
    </div>
    </div>
    <hr>
@empty
    <div>No orders</div>
@endforelse
