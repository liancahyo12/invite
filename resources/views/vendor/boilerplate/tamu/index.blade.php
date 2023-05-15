@extends('boilerplate::layout.index', [
    'title' => __('Tamu'),
    'subtitle' => 'Daftar Tamu',
    'breadcrumb' => ['Daftar Tamu']]
)

@section('content')
    <x-boilerplate::card title="Daftar Tamu">
        <x-slot name="tools">
            <a href="/tambah-tamu"><button class="btn btn-primary">Tambah</button></a>
        </x-slot>
        <x-boilerplate::datatable name="tamu" />
    </x-boilerplate::card>
@endsection