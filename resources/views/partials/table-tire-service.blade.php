@if( $setting && !empty($setting['data0']) )
    <table class="table table-bordered text-center hideseek-data">
        <thead class="bg-orange text-white">
        <tr>
            <th scope="col" rowspan="2" class="align-middle">Виды услуг<br>(Цена в рублях за единицу)</th>
            <th scope="col" colspan="7">Легковые автомобили</th>
            <th scope="col" colspan="6">Внедорожники</th>
        </tr>
        <tr>
            <th scope="col">12-16</th>
            <th scope="col">17</th>
            <th scope="col">18</th>
            <th scope="col">19</th>
            <th scope="col">20</th>
            <th scope="col">21</th>
            <th scope="col">22</th>
            <th scope="col">15-18</th>
            <th scope="col">19</th>
            <th scope="col">20</th>
            <th scope="col">21</th>
            <th scope="col">22</th>
            <th scope="col">23-26</th>
        </tr>
        </thead>
        <tbody class="text-white">
        @foreach( $setting['data0'] as $row )
            @if( count(array_filter($row, fn($item) => $item !== null)) == 1)
                <tr class="border-0 text-center h5 bg-secondary">
                    <th scope="row" colspan="14">{{ $row['value0'] }}</th>
                </tr>
                @continue
            @endif
            @php
                $colspan = searchColspan($row);
            @endphp
            <tr class="text-center">
                @foreach( $row as $key => $value )
                    @if( isset($colspan[$key]))
                        @if( $colspan[$key] > 1 )
                            <td {{ ($loop->index == 1 ? 'scope="row"' : '') }} colspan="{{ $colspan[$key] }}">{{ $value }}</td>
                        @else
                            <td {{ ($loop->index == 1 ? 'scope="row"' : '') }} >{{ $value }}</td>
                        @endif
                        @continue
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
