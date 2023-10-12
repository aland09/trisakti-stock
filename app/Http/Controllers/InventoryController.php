<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryRequest;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\ImportBarang;
use Maatwebsite\Excel\Facades\Excel;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Inventory List',
            'controller' => 'Inventory',
            "no_box_tmp" => $this->generate_no_box()
        ];

        $compact = [
            'data',
        ];

        return view('index', compact($compact));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $rooms = Room::all();

        $data = [
            'title' => 'Create Inventory',
            'controller' => 'Inventory',
            'type' => 'Create',
        ];

        $inventory = '';

        $compact = [
            'data',
            'inventory',
            'categories',
            'rooms',
        ];

        return view('inventory.form', compact($compact));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $category = Category::findOrFail($request->category_id);
            $room = Room::findOrFail($request->room_id);

            $categoryCode = $category->code;
            $roomCode = $room->code;

            $data = $request->all();
            // $data['id'] = mt_rand(0,100);
            $data['name'] = ucwords($data['name']);
            $data['slug'] = Str::slug($data['name']);
            $data['image'] = $request->file('image')->store('inventory', 'public');
            $data['code'] = $categoryCode . '-' . $roomCode . '-' . date('Y') . mt_rand(0, 9999);

            $inventory = Inventory::create($data);
            $inventoryName = $inventory->name;

            DB::commit();

            return redirect()->route('inventories.index')->with('success',  'Success! ' . strtoupper($inventoryName) . ' has been created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::where('id', $id)->firstOrFail();
        $categories = Category::all();
        $rooms = Room::all();

        $data = [
            'title' => $inventory->name,
            'controller' => 'Inventory',
            'type' => 'Show',
        ];

        $compact = [
            'data',
            'categories',
            'inventory',
            'rooms',
        ];

        return view('inventory.form', compact($compact));
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $no_box
     * @return \Illuminate\Http\Response
     */
    public function detailcoba($no_box)
    {
        $inventory = Inventory::where('no_box', $no_box)->firstOrFail();
        $categories = Category::all();
        $rooms = Room::all();

        $data = [
            'title' => $inventory->name,
            'controller' => 'Inventory',
            'type' => 'Details',
        ];

        $compact = [
            'data',
            'categories',
            'inventory',
            'rooms',
        ];

        return view('inventory.coba', compact($compact));

    }

    
        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $no_box
     * @return \Illuminate\Http\Response
     */

    public function details($no_box)
    {
        $inventory = Inventory::where('no_box', $no_box)->get();
        $categories = Category::all();
        $rooms = Room::all();


        $data = [
            'title' => 'Detail Barang',
            'controller' => 'Inventory',
            'type' => 'Details',
            'no_box' => $no_box,
        ];

        $compact = [
            'data',
            'categories',
            'inventory',
            'rooms',
            'no_box',
            
        ];
        // if($inventory->count() > 0){
        // dd($inventory);
        // }
        return view('inventory.form', compact($compact));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::where('id', $id)->firstOrFail();
        $categories = Category::all();
        $rooms = Room::all();

        $data = [
            'title' => 'Edit ' . $inventory->name,
            'controller' => 'Inventory',
            'type' => 'Edit',
        ];

        $compact = [
            'data',
            'categories',
            'inventory',
            'rooms',
        ];

        return view('inventory.form', compact($compact));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $category = Category::findOrFail($request->category_id);
            $room = Room::findOrFail($request->room_id);

            $categoryCode = $category->code;
            $roomCode = $room->code;

            $data = $request->all();
            $data['name'] = ucwords($data['name']);
            $data['slug'] = Str::slug($data['name']);
            $data['code'] = $categoryCode . '-' . $roomCode . '-' . date('Y') . mt_rand(0, 9999);

            $inventory = Inventory::where('id', $id)->firstOrFail();

            if ($request->hasFile('image')) {
                if ($inventory->image) {
                    Storage::delete($inventory->image);
                    $data['image'] = $request->file('image')->store('inventory', 'public');
                } else {
                    $data['image'] = $request->file('image')->store('inventory', 'public');
                }
            } else {
                $data['image'] = $inventory->image;
            }

            $inventory->update([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'room_id' => $data['room_id'],
                'code' => $data['code'],
                'quantity' => $data['quantity'],
                'satuan' => $data['satuan'],
                'description' => $data['description'],
                'image' => $data['image'],
            ]);

            $inventoryName = $inventory->name;

            DB::commit();

            return redirect()->route('inventories.index')->with('success', 'Success! ' . strtoupper($inventoryName) . ' has been updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $inventory = Inventory::where('id', $id)->firstOrFail();
            $transactions = Transaction::where('inventory_id', $inventory->id)->exists();

            if ($transactions) {
                return redirect()->route('inventories.index')->with('error', "Sorry, The item cannot be deleted as it has associated transactions.");
            } else {
                Storage::delete($inventory->image);
                $inventoryName = $inventory->name;
                $inventory->delete();
            }

            DB::commit();

            return redirect()->route('inventories.index')->with('error', 'Well done! ' . strtoupper($inventoryName) . ' deletion process has been completed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('inventories.index')->with('error', $e->getMessage());
        }
    }

    public function get_no_box() {
        return response()->json($this->generate_no_box());
    }

    public function detail_box($no_box)
    {
        
        $berkas_dokumen = Inventory::where('no_box',$no_box)->latest()->get();



        return view("inventory/detail-box", [
            "title"             => "Detail Data Dokumen Masuk",
            "no_box"            => $no_box,
            "berkas_dokumen"    => $berkas_dokumen
        ]);

    }

    public function generate_no_box() {
        $counter = Inventory::whereNotNull('no_box')->distinct()->count('no_box');
        $current_number = "T0". $counter+1;
        $no_box = $current_number.mt_rand(0, 9999)."-TS";
        return $no_box;
    }


    public function update_no_box(Request $request) {
        $ids = $request['id'];
        // $idsImplode = implode(',', $ids);
        $id = explode(",",$ids[0]);
        // dd($id);
        // $kurun_waktu = $request['kurun_waktu'];
        $no_box = $this->generate_no_box();
        $data['no_box'] = $no_box;
        
        
        foreach($id as $item) {
            
            Inventory::where('id', $item)->update($data);
            //  DetailDokumen::where('dokumen_id', $item)->update($data);
        }

        return redirect()->route('inventories.index')->with('success','No. Box telah berhasil diperbaharui');
    }

    public function datatables()
    {
        $inventories = Inventory::latest()->get();

    return DataTables::of($inventories)
            ->addColumn('checkbox1','<input type="checkbox" name="select1[]" class="selectbox" value="{{$id}}"/>')
            
            ->addColumn('Barcode', function ($row) {
                $barcode = "";
                if ($row->no_box) {
                    $barcode = view('layouts.partials.image-barcode', ['item' => $row->no_box])->render();
                } else {
                    $barcode = "tidak ada";
                }
                return $barcode;

            })
            ->addColumn('category', function ($row) {
                $category = "";
                if ($row->category) {
                    $category = $row->category->name;
                } else {
                    $category = "-";
                }
                return $category;
            })
            ->addColumn('image', function ($row) {
                $image = "";
                if($row->image){
                $image = view('layouts.partials.image-modal', ['image' => $row->image , 'data' => $row->id])->render();
                } else{
                    $image = "-";
                }
                return $image;
            })
            ->addColumn('action', function ($row) {
                $btn_view = view('layouts.partials.button-view', ['data' => $row->id, 'route' => 'inventories.show'])->render();
                $btn_edit = view('layouts.partials.button-edit', ['data' => $row->id, 'route' => 'inventories.edit'])->render();
                $btn_delete = view('layouts.partials.button-delete', ['data' => $row->id, 'route' => 'inventories.destroy', 'name' => $row->name])->render();
                return '<div class="d-flex">' . $btn_view . $btn_edit . $btn_delete . '</div>';
            })
            ->rawColumns(['action', 'image', 'category','checkbox1','Barcode'])
            ->make(true);
    }

    public function import_excel(Request $request) 
	{
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		$file = $request->file('file');

		$nama_file = rand().$file->getClientOriginalName();

		$file->move('file_dokumen',$nama_file);

        try{
        // Excel::import(new DokumenImport, public_path('/file_dokumen/'.$nama_file));
        Excel::import(new ImportBarang, public_path('/file_dokumen/'.$nama_file));
        return redirect()->route('inventories.index')->with('message','Data arsip berhasil diimport');
	    // Excel::import(new DetailDokumenImport, public_path('/file_dokumen/'.$nama_file));
        }catch(\Maatwebsite\Excel\Validators\ValidationException $e){
    //         $failures = $e->failures();
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
    //     foreach ($failures() as $failure) {
    //         $failure->row(); // row that went wrong
    //         $failure->attribute(); // either heading key (if using heading row concern) or column index
    //         $failure->errors(); // Actual error messages from Laravel validator
    //         $failure->values(); // The values of the row that has failed.
    //    }
    }
        

	}
}
