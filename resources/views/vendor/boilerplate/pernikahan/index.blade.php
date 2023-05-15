@extends('boilerplate::layout.index', [
    'title' => __('Pernikahan'),
    'subtitle' => 'Data Pernikahan',
    'breadcrumb' => ['Data Pernikahan']]
)

@section('content')
    <x-boilerplate::form :route="['boilerplate.store-pernikahan']" method="post">
        @csrf
        <x-boilerplate::card>
            <x-boilerplate::input name="nama_cowo" id="nama_cowo" label="Nama Lengkap Pengantin Pria*" required/>
            <x-boilerplate::input name="nama_al_cowo" id="nama_al_cowo" label="Nama Panggilan Pengantin Pria*" required/>
            <x-boilerplate::input name="nama_cewe" id="nama_cewe" label="Nama Lengkap Pengantin Wanita*" required/>
            <x-boilerplate::input name="nama_al_cewe" id="nama_al_cewe" label="Nama Panggilan Pengantin Wanita*" required/>
            <x-boilerplate::input name="nama_pak_cowo" id="nama_mak_cowo" label="Nama Ayah Pengantin Pria*" required/>
            <x-boilerplate::input name="nama_mak_cowo" id="nama_pak_cowo" label="Nama Ibu Pengantin Pria*" required/>
            <x-boilerplate::input name="nama_pak_cewe" id="nama_pak_cewe" label="Nama Ayah Pengantin Wanita*" required/>
            <x-boilerplate::input name="nama_mak_cewe" id="nama_mak_cewe" label="Nama Ibu Pengantin Wanita*" required/>
            <x-boilerplate::datetimepicker name="akad" id="akad" label="Tanggal Akad" format="dddd, DD-MM-YYYY HH:mm"/>
            <x-boilerplate::datetimepicker name="resepsi" id="resepsi" label="Tanggal Resepsi" format="dddd, DD-MM-YYYY HH:mm"/>
            <x-boilerplate::input name="alamat_akad" id="alamat_akad" label="Alamat Akad"/>
            <x-boilerplate::input name="alamat_resepsi" id="alamat_resepsi" label="Alamat Resepsi"/>
            <x-boilerplate::input name="map" id="map" label="Google Map Alamat Resepsi"/>
            <x-boilerplate::input name="sambutan1" id="sambutan1" label="Sambutan 1"/>
            <x-boilerplate::input name="sambutan2" id="sambutan2" label="Sambutan 2"/>
            <x-boilerplate::input name="sambutan3" id="sambutan3" label="Sambutan 3"/>
            <x-boilerplate::input name="sambutan4" id="sambutan4" label="Sambutan 4"/>
        </x-boilerplate::card>
        <div class="row">
            <button type="submit" class="btn btn-success btn-block text-white">Submit</button>
        </div>
    </x-boilerplate::form>
@endsection