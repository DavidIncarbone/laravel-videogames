<tr>
    <td>
        <div class="d-flex justify-content-center w-100" style="height: 66px">
            {{ $checkbox }}
        </div>
    </td>


    {{-- FIRST TD --}}

    <td id="table-videogame-name" class="w-25">{{ $firstTd }}</td>

    {{-- SECOND TD --}}

    {{ $secondTd }}

    {{-- CREATED AND UPDATED TD --}}

    <td class="not-break">{{ $created }}</td>
    <td class="not-break">{{ $updated }}</td>
    <td>
        {{ $show }}
        <a class="text-decoration-none text-dark" {{ $edit }}>
            <i id="pencil" class="bi bi-pencil"></i>
        </a>
        {{ $delete }}
    </td>
</tr>
