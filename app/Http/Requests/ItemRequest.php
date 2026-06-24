<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'category_id'   => 'required|exists:categories,id',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string|max:2000',
            'location'      => 'required|string|max:255',
            'lost_or_found' => 'required|in:lost,found',
            'date'          => 'required|date|before_or_equal:today',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'category_id.required'   => 'Kategori wajib dipilih.',
            'category_id.exists'     => 'Kategori tidak valid.',
            'title.required'         => 'Judul barang wajib diisi.',
            'title.max'              => 'Judul maksimal 255 karakter.',
            'description.required'   => 'Deskripsi wajib diisi.',
            'description.max'        => 'Deskripsi maksimal 2000 karakter.',
            'location.required'      => 'Lokasi wajib diisi.',
            'lost_or_found.required' => 'Status barang wajib dipilih.',
            'lost_or_found.in'       => 'Status tidak valid.',
            'date.required'          => 'Tanggal wajib diisi.',
            'date.date'              => 'Format tanggal tidak valid.',
            'date.before_or_equal'   => 'Tanggal tidak boleh lebih dari hari ini.',
            'image.image'            => 'File harus berupa gambar.',
            'image.mimes'            => 'Format gambar harus jpg, jpeg, atau png.',
            'image.max'              => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
