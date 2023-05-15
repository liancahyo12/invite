@extends('boilerplate::layout.index', [
    'title' => __('Bank'),
    'subtitle' => 'Daftar Bank',
    'breadcrumb' => ['Daftar Bank']]
)

@section('content')
    <x-boilerplate::card title="Daftar Bank">
        <x-slot name="tools">
            <a href="/tambah-bank"><button class="btn btn-primary">Tambah</button></a>
        </x-slot>
        <x-boilerplate::datatable name="bank" />
    </x-boilerplate::card>
@endsection