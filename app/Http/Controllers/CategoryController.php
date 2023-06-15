<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
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
            'title' => 'Category List',
            'controller' => 'Category',
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
        $data = [
            'title' => 'Create Category',
            'type' => 'Create',
        ];

        $category = '';

        $compact = [
            'data',
            'category',
        ];

        return view('category.form', compact($compact));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['name'] = ucwords($data['name']);
            $data['code'] = strtoupper($data['code']);

            $category = Category::create($data);
            $categoryName = $category->name;

            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Success! ' . strtoupper($categoryName) . ' has been created successfully.');
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
        $category = Category::findOrFail($id);
        $data = [
            'title' => $category->name,
            'controller' => 'category',
            'type' => 'Show',
        ];

        $compact = [
            'data',
            'category',
        ];

        return view('category.form', compact($compact));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $data = [
            'title' => 'Edit ' . $category->name,
            'controller' => 'category',
            'type' => 'Edit',
        ];

        $compact = [
            'data',
            'category',
        ];

        return view('category.form', compact($compact));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['name'] = ucwords($data['name']);

            $category = Category::findOrFail($id);
            $category->update([
                'name' => $data['name'],
                'code' => $data['code'],
                'description' => $data['description'],
            ]);

            $categoryName = $category->name;

            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Success! ' . strtoupper($categoryName) . ' has been updated successfully.');
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
            $inventories = Inventory::where('category_id', $id)->get();
            $category = Category::findOrFail($id);
            foreach ($inventories as $inventory) {
                // $inventory->delete();
                $code = $inventory->code;
                $code = substr_replace($code, 'XXX', 0, 3);
                $inventory->update([
                    'category_id' => null,
                    'code' => $code,
                ]);
            }
            $category->delete();
            $categoryName = $category->name;

            DB::commit();

            return redirect()->route('categories.index')->with('error', 'Well done! ' . strtoupper($categoryName) . ' deletion process has been completed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('categories.index')->with('error', $e->getMessage());
        }
    }

    public function datatables()
    {
        $categories = Category::latest()->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($row) {
                $btn_view = view('layouts.partials.button-view', ['data' => $row->id, 'route' => 'categories.show'])->render();
                $btn_edit = view('layouts.partials.button-edit', ['data' => $row->id, 'route' => 'categories.edit'])->render();
                $btn_delete = view('layouts.partials.button-delete', ['data' => $row->id, 'route' => 'categories.destroy', 'name' => $row->name, 'messages' => ''])->render();
                return '<div class="d-flex">' . $btn_view . $btn_edit . $btn_delete . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
