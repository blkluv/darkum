@extends('layouts.userLayout')
@section('title', 'annonces')
@section('content')
<div class="card shadow mb-4">

    <x-section sectionTitle='Announces' />

    <a style="border-radius: 0; width: 100%" href="{{ route('announces.create') }}" class="btn btn-primary mt-1">create a new announce</a>
    <div class="announces">
        <table class="table">
        @isset($announces)
            @forelse ($announces as $item)
                <tr class="annonce">
                    <td> <h4 class="title"> {{ $item->title }} </h4> </td>
                    <td>
                        <form action='{{ route('announces.destroy', $item->id) }}' class="butthons" method='post'>
                            @method('DELETE')
                            @csrf
                            <a href="{{ route('announces.edit', $item->id) }}"> <i class="fa-solid fa-pen-to-square"></i> </a>
                            <a href="{{ route('announces.edit', $item->id) }}"> <i class="fa-solid fa-eye"></i> </a>
                            <a href="{{ route('comments', $item->id) }}"> <i class="fa-solid fa-comment"></i> </a>
                            <button type='submit'> <i class="fa-solid fa-trash"></i> </button>
                            </ul>
                        </form>
                    </td>
                </tr>
            @empty
            <p></p>
            @endforelse
        @endisset
    </table>
</div>
</div>
@endsection