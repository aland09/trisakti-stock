<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['name'] = ucwords($data['name']);

            Category::create($data);

            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Success! The data has been created successfully.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatables()
    {
        $categories = Category::latest()->get();

        return DataTables::of($categories)
            // ->addColumn('Action', function ($row) {
            //     $btn_view = view('layouts.partials.button-view', ['data' => $row->id, 'route' => 'orders.show'])->render();
            //     $btn_edit = view('layouts.partials.button-edit', ['data' => $row->id, 'route' => 'orders.edit'])->render();
            //     $btn_delete = view('layouts.partials.button-delete', ['data' => $row->id, 'route' => 'orders'])->render();
            //     return '<div class="d-flex">' . $btn_view . $btn_edit . $btn_delete . '</div>';
            // })
            // ->rawColumns(['Action', 'Status', 'Image'])
            ->make(true);
    }
}
