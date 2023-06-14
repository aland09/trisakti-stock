<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
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
            'title' => 'Room List',
            'controller' => 'Room',
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
            'title' => 'Create Room',
            'type' => 'Create',
        ];

        $room = '';

        $compact = [
            'data',
            'room',
        ];

        return view('room.form', compact($compact));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['name'] = ucwords($data['name']);
            $data['code'] = strtoupper($data['code']);

            $room = Room::create($data);
            $roomName = $room->name;

            DB::commit();

            return redirect()->route('rooms.index')->with('success', 'Success! ' . strtoupper($roomName) . ' has been created successfully.');
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
        $room = Room::findOrFail($id);
        $data = [
            'title' => $room->name,
            'controller' => 'room',
            'type' => 'Show',
        ];

        $compact = [
            'data',
            'room',
        ];

        return view('room.form', compact($compact));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $data = [
            'title' => 'Edit ' . $room->name,
            'controller' => 'room',
            'type' => 'Edit',
        ];

        $compact = [
            'data',
            'room',
        ];

        return view('room.form', compact($compact));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['name'] = ucwords($data['name']);

            $room = Room::findOrFail($id);
            $room->update([
                'name' => $data['name'],
                'code' => $data['code'],
                'description' => $data['description'],
            ]);

            $roomName = $room->name;

            DB::commit();

            return redirect()->route('rooms.index')->with('success', 'Success! ' . strtoupper($roomName) . ' has been updated successfully.');
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
            $room = Room::findOrFail($id);
            $room->delete();
            $roomName = $room->name;

            DB::commit();

            return redirect()->route('rooms.index')->with('error', 'Well done! ' . strtoupper($roomName) . ' deletion process has been completed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('rooms.index')->with('error', $e->getMessage());
        }
    }

    public function datatables()
    {
        $rooms = Room::latest()->get();

        return DataTables::of($rooms)
            ->addColumn('action', function ($row) {
                $btn_view = view('layouts.partials.button-view', ['data' => $row->id, 'route' => 'rooms.show'])->render();
                $btn_edit = view('layouts.partials.button-edit', ['data' => $row->id, 'route' => 'rooms.edit'])->render();
                $btn_delete = view('layouts.partials.button-delete', ['data' => $row->id, 'route' => 'rooms.destroy', 'name' => $row->name])->render();
                return '<div class="d-flex">' . $btn_view . $btn_edit . $btn_delete . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
