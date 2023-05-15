@extends('boilerplate::layout.index', [
    'title' => __('Galeri'),
    'subtitle' => 'Galeri',
    'breadcrumb' => ['Galeri']]
)

@section('content')
    <x-boilerplate::card title="Galeri">
        <x-slot name="tools">
            <a href="/tambah-galeri"><button class="btn btn-primary">Tambah</button></a>
        </x-slot>
        <x-boilerplate::datatable name="galeri" />
    </x-boilerplate::card>
@endsection