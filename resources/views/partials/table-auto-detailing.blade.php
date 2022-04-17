@if( $setting && !empty($setting['data0']) )
    <table class="table">
        <thead class="bg-orange text-white">
        <tr class="border-0">
            <th scope="col">
                Категория автотраспорта*<br>
                <small>(*право определния категории остается за администратором, при отсутствии в каталоге)</small>
                </th>
            <th scope="col">I группа</th>
            <th scope="col">II группа</th>
            <th scope="col">III группа</th>
            <th scope="col">IV группа</th>
            <th scope="col">V группа</th>
        </tr>
        </thead>
        <tbody class="text-white">
        @foreach( $setting['data0'] as $row )
            @if( count(array_filter($row, fn($item) => $item !== null)) == 1)
                <tr class="border-0 text-center h5 bg-secondary">
                    <th scope="row" colspan="6">{{ $row['value0'] }}</th>
                </tr>
                @continue
            @endif
            @php
                $colspan = searchColspan($row);
            @endphp
            <tr class="border-0">
                @foreach( $row as $key => $value )
                    @if( isset($colspan[$key]))
                        @if( $colspan[$key] > 1 )
                            <td {{ $loop->index == 1 ? 'scope="row"' : '' }} colspan="{{ $colspan[$key] }}">{{ $value }}</td>
                        @else
                            <td {{ $loop->index == 1 ? 'scope="row"' : '' }} >{{ $value }}</td>
                        @endif
                        @continue
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
