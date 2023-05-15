@extends('boilerplate::layout.index', [
    'title' => __('Rekening'),
    'subtitle' => 'Daftar Rekening',
    'breadcrumb' => ['Daftar Rekening']]
)

@section('content')
    <x-boilerplate::card title="Daftar Rekening">
        <x-slot name="tools">
            <a href="/tambah-rekening"><button class="btn btn-primary">Tambah</button></a>
        </x-slot>
        <x-boilerplate::datatable name="rekening" />
    </x-boilerplate::card>
@endsection