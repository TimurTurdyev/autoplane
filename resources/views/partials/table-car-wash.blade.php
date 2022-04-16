@if( $table )
    <table class="table">
        <thead class="bg-orange text-white">
        <tr class="border-0">
            <th scope="col">Категория автотранспорта</th>
            <th scope="col">I группа</th>
            <th scope="col">II группа</th>
            <th scope="col">III группа</th>
            <th scope="col">IV группа</th>
            <th scope="col">V группа</th>
        </tr>
        </thead>
        <tbody class="text-white">
        @foreach( $table as $row )
            @if( count(array_filter($row, fn($item) => $item !== null)) == 1)
                <tr class="border-0 text-center h5 bg-secondary">
                    <th scope="row" colspan="6">{{ $row['type'] }}</th>
                </tr>
                @continue
            @endif
            <tr class="border-0">
                <th scope="row">{{ $row['type'] }}</th>
                <td>{{ $row['group1'] }}</td>
                <td>{{ $row['group2'] }}</td>
                <td>{{ $row['group3'] }}</td>
                <td>{{ $row['group4'] }}</td>
                <td>{{ $row['group5'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
