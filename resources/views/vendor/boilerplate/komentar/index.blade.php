@extends('boilerplate::layout.index', [
    'title' => __('Komentar'),
    'subtitle' => 'Daftar Komentar',
    'breadcrumb' => ['Daftar Komentar']]
)

@section('content')
    <x-boilerplate::card title="Daftar Komentar">
        <x-boilerplate::datatable name="komentar" />
    </x-boilerplate::card>
@endsection