<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryRequest;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

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
            $data = $request->all();
            $data['name'] = ucwords($data['name']);
            $data['slug'] = Str::slug($data['name']);
            $data['image'] = $request->file('image')->store('inventory', 'public');
            $data['code'] = 'INV' . substr(date('Y'), -2) . '000' . mt_rand(0, 9999);

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
    public function show($slug)
    {
        $inventory = Inventory::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        $data = [
            'title' => $inventory->name,
            'controller' => 'Inventory',
            'type' => 'Show',
        ];

        $compact = [
            'data',
            'categories',
            'inventory',
        ];

        return view('inventory.form', compact($compact));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $inventory = Inventory::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        $data = [
            'title' => 'Edit ' . $inventory->name,
            'controller' => 'Inventory',
            'type' => 'Edit',
        ];

        $compact = [
            'data',
            'categories',
            'inventory',
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
    public function update(InventoryRequest $request, $slug)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['name'] = ucwords($data['name']);
            $data['slug'] = Str::slug($data['name']);

            $inventory = Inventory::where('slug', $slug)->firstOrFail();

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
    public function destroy($slug)
    {
        DB::beginTransaction();

        try {
            $inventory = Inventory::where('slug', $slug)->firstOrFail();
            $inventory->delete();
            Storage::delete($inventory->image);
            $inventoryName = $inventory->name;

            DB::commit();

            return redirect()->route('inventories.index')->with('error', 'Well done! ' . strtoupper($inventoryName) . ' deletion process has been completed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('inventories.index')->with('error', $e->getMessage());
        }
    }

    public function datatables()
    {
        $inventories = Inventory::latest()->get();

        return DataTables::of($inventories)
            ->addColumn('category', function ($row) {
                $category = $row->category->name;
                return $category;
            })
            ->addColumn('image', function ($row) {
                $image = view('layouts.partials.image-modal', ['image' => $row->image, 'data' => $row->id])->render();
                return $image;
            })
            ->addColumn('action', function ($row) {
                $btn_view = view('layouts.partials.button-view', ['data' => $row->slug, 'route' => 'inventories.show'])->render();
                $btn_edit = view('layouts.partials.button-edit', ['data' => $row->slug, 'route' => 'inventories.edit'])->render();
                $btn_delete = view('layouts.partials.button-delete', ['data' => $row->slug, 'route' => 'inventories.destroy', 'name' => $row->name])->render();
                return '<div class="d-flex">' . $btn_view . $btn_edit . $btn_delete . '</div>';
            })
            ->rawColumns(['action', 'image', 'category'])
            ->make(true);
    }
}