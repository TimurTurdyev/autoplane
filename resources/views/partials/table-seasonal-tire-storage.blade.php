@if( $setting && !empty($setting['data0']) )
    <table class="table">
        <thead class="bg-orange text-white">
        <tr class="border-0">
            <th scope="col">Категория</th>
            <th scope="col">R13-R15</th>
            <th scope="col">R16-R17</th>
            <th scope="col">R18-R19</th>
            <th scope="col">R20-R21</th>
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
