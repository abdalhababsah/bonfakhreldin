
<div class="table-responsive">
    <table class="table align-items-center">
        <thead>
            <tr>
                <th>{{__('Product')}}</th>
                <th>{{__('Price')}}</th>
                <th>{{__('Quantity')}}</th>
                <th>{{__('Total')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td class="d-flex align-items-center">
                        <img
                        @if ($item->product->primaryImage)
                        src="{{ asset('storage/' . $item->product->primaryImage->image_url) }}"
                        style="max-height: 150px"
                        alt="{{ $item->product->name }}"
                        @else
                        src="https://via.placeholder.com/50"
                        alt="Primary Image"
                        @endif
                        class="img-fluid rounded me-3" width="50">
                        <div>
                            <span class="text-wrap">{{ $item->product->name }} - {{ $item->size }}
                                @if ($item->option)
                                    - {{ $item->option }}
                                @endif
                            </span>
                            @if (!empty($item->additions))
                                <br>
                                <ul>
                                    @foreach ($item->additions as $itemAddition)
                                    <li>
                                        <small>{{ $itemAddition['name'] ?? 'NAN' }} {{ $itemAddition['quantity'] > 1 ? '×'.$itemAddition['quantity']:''}}</small>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>