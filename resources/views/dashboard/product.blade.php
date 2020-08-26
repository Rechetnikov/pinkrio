@if($products)
    <tr>
        <td>{{ $products['title'] }}</td>
        <td>{{ $products['text'] }}</td>
        <td>{{ $products['prise'] }}</td>
    </tr>
@endif