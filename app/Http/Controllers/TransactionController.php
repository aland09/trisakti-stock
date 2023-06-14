<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Transaction List',
            'controller' => 'Transaction',
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
        $inventories = Inventory::all();
        // $inventories = Inventory::first();
        // dd($inventories);

        $data = [
            'title' => 'Create Transaction',
            'type' => 'Create',
        ];

        $transaction = '';

        $compact = [
            'data',
            'transaction',
            'inventories',
        ];

        return view('transaction.form', compact($compact));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['uuid'] = 'TRS' . mt_rand(0, 9999);

            $transaction = Transaction::create($data);

            $inventory = Inventory::findOrFail($data['inventory_id']);
            if ($data['status'] == 'masuk') {
                $inventory->quantity += $data['quantity'];
            } else if ($data['status'] == 'keluar' || $data['status'] == 'pinjam') {
                $inventory->quantity -= $data['quantity'];
            }
            $inventory->save();

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Success! Transaction has been created successfully.');
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
        $transaction = Transaction::findOrFail($id);
        $inventories = Inventory::all();

        $data = [
            'title' => $transaction->name,
            'controller' => 'Transaction',
            'type' => 'Show',
        ];

        $compact = [
            'data',
            'inventories',
            'transaction',
        ];

        return view('transaction.form', compact($compact));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $inventories = Inventory::all();

        $data = [
            'title' => $transaction->name,
            'controller' => 'Transaction',
            'type' => 'Edit',
        ];

        $compact = [
            'data',
            'inventories',
            'transaction',
        ];

        return view('transaction.form', compact($compact));
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
        DB::beginTransaction();

        try {
            $data = $request->all();
            $transaction = Transaction::findOrFail($id);
            $transaction->update([
                'date' => $data['date'],
                'inventory_id' => $data['inventory_id'],
                'quantity' => $data['quantity'],
                'status' => $data['status'],
                'notes' => $data['notes'],
            ]);

            $inventory = Inventory::findOrFail($data['inventory_id']);
            if ($data['status'] == 'masuk') {
                $inventory->quantity += $data['quantity'];
            } else if ($data['status'] == 'keluar' || $data['status'] == 'pinjam') {
                $inventory->quantity -= $data['quantity'];
            }
            $inventory->save();

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Success! Transaction has been created successfully.');
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
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            DB::commit();

            return redirect()->route('transactions.index')->with('error', 'Well done! Transaction deletion process has been completed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('rooms.index')->with('error', $e->getMessage());
        }
    }

    public function datatables()
    {
        $transactions = Transaction::with('inventory')->latest()->get();
        // dd($transactions);

        return DataTables::of($transactions)
            ->addColumn('inventory', function ($row) {
                $inventory = $row->inventory->name;
                return $inventory;
            })
            ->addColumn('status', function ($row) {
                $inventory = '';
                if ($row->status == 'masuk') {
                    $inventory = '<span class="badge bg-success py-2">Masuk</span>';
                } else if ($row->status == 'keluar') {
                    $inventory = '<span class="badge bg-danger py-2">Keluar</span>';
                } else if ($row->status == 'pinjam') {
                    $inventory = '<span class="badge bg-primary py-2">Dipinjamkan</span>';
                }
                return $inventory;
            })
            ->addColumn('quantity', function ($row) {
                $qwuantity = "";
                if ($row->status == 'masuk') {
                    $qwuantity = '<span class="badge bg-success p-2">+' . $row->quantity . '</span>';
                } else if ($row->status == 'keluar') {
                    $qwuantity = '<span class="badge bg-danger p-2">-' . $row->quantity . '</span>';
                } else if ($row->status == 'pinjam') {
                    $qwuantity = '<span class="badge bg-primary p-2">-' . $row->quantity . '</span>';
                }
                return $qwuantity;
            })
            ->addColumn('stock', function ($row) {
                $stock = $row->inventory->quantity . ' ' . $row->inventory->satuan;
                return $stock;
            })
            ->addColumn('action', function ($row) {
                $btn_view = view('layouts.partials.button-view', ['data' => $row->id, 'route' => 'transactions.show'])->render();
                $btn_edit = view('layouts.partials.button-edit', ['data' => $row->id, 'route' => 'transactions.edit'])->render();
                $btn_delete = view('layouts.partials.button-delete', ['data' => $row->id, 'route' => 'transactions.destroy', 'name' => $row->name])->render();
                return '<div class="d-flex">' . $btn_view . $btn_edit . $btn_delete . '</div>';
            })
            ->rawColumns(['action', 'status', 'inventory', 'quantity', 'stock'])
            ->make(true);
    }
}
