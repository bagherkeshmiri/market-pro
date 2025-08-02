<div>
    <div class="table-responsive">
        <table class="table mb-0 table-hover">
            <thead>
            <tr>
                @foreach($addressTableHeads as $addressTableHead)
                    <th>{{ $addressTableHead }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody class="font-13">

            @forelse ($addresses as $address)
                <tr>
                    <td class="text-white">{{ $address->province->name }}</td>
                    <td class="text-white">{{ $address->city->name }}</td>
                    <td class="text-white">{{ $address->address }}</td>
                    <td class="text-white">{{ $address->postal_code }}</td>
                </tr>

            @empty
                @include('custom-components.admin.empty-table')
            @endforelse

            </tbody>
        </table>

        {{ $addresses->links('frest-components.pagination',['elements' => $addresses]) }}

    </div>
</div>
