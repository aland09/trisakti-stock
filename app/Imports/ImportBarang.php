<?php

namespace App\Imports;

use App\Models\Inventory;
use App\Models\Category;
use App\Models\Room;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;



class ImportBarang implements WithStartRow, WithHeadingRow, SkipsEmptyRows, WithValidation, ToCollection
{
    
    public function rules(): array
    {
        return [
            'name' => 'required',
            // 'code' => 'required|unique',
            // 'nama_category' => 'required|unique:categories',
            // 'deskripsi' => 'required',
            // 'tanggal_pembelian' => 'required',
            // 'harga_beli' => 'required',
        ];
    }
    
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
        // try{
        // $categoryId2 = Category::select('id','nama_category')->where('nama_category',$row['category'])->first(); }
        // catch(\Maatwebsite\Excel\Validators\ValidationException $e){ 
        $categoryId = Category::firstOrCreate([
            'name' => $row['category']
          ]) ;
        // $roomId = Room::firstOrCreate([
        //     'name' => $row['room']
        //   ]) ;
        // }
         Inventory::updateOrcreate([
                'category_id' =>  $categoryId->id,
              'name' => $row['name'],
              // 'category' => $row['category'],
              'description' => $row['description'],
              // 'tanggal_pembelian' =>  \Carbon\Carbon::parse($row['tanggal_pembelian'])->isoFormat('YYYY-MM-DD HH:mm:ss'),
            //   'tanggal_pembelian' =>  \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_pembelian'])),
              'quantity' => $row['quantity'],
              'satuan' => $row['satuan'],
              'code' => $row['code'],
            //   'room_id' => $roomId->id,
              // 'harga_beli' => $row['harga_beli']
          ]);
            
         }
        
        
    }


    /**
     * @return int
     */
    public function startRow(): int
    {
    return 2;
    }

    // public function upsertColumns()
    // {
    //     return 'jumlah_barang';
    // }

    // public function uniqueBy()
    // {
    //     return 'nama_barang';
    // }

    
}
