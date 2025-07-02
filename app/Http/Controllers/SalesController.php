<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use Exception;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::all();

        return view('user.sales.index', [
            'sales' => $sales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        try 
        {
            $sales = new Sales;
            $sales->name = $request->name;
            $sales->email = $request->email;
            $sales->no_hp = $request->no_hp;
            // semua sales di non aktifkan dulu
            if ($request->is_sales_assigned == 1) {
                Sales::where('is_sales_assigned', 1)->update(['is_sales_assigned' => 0]);
            }

            $sales->is_sales_assigned = $request->is_sales_assigned;
            $sales->save();

            return redirect()->route('sales.index')->with('success', 'Sales berhasil ditambahkan');
        } 
        catch (Exception $e) 
        {
            return redirect()->back()->with('error', 'Gagal tambah sales. Silahkan coba lagi');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sales = Sales::findOrFail($id);

        return view('user.sales.edit', [
            'sales' => $sales
        ]);
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
        $this->validate($request, [
            'name' => 'required',
        ]);

        try 
        {
            $sales = Sales::findOrFail($id);
            $sales->name = $request->name;
            $sales->email = $request->email;
            $sales->no_hp = $request->no_hp;

            // semua sales di non aktifkan dulu
            if ($request->is_sales_assigned == 1) {
                Sales::where('is_sales_assigned', 1)->update(['is_sales_assigned' => 0]);
            }
            $sales->is_sales_assigned = $request->is_sales_assigned;
            $sales->save();

            
            return redirect()->route('sales.index')->with('success', 'Sales berhasil diupdate');
        } 
        catch (Exception $e) 
        {
            return redirect()->back()->with('error', 'Gagal update sales. Silahkan coba lagi');
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
        try 
        {
            Sales::findOrFail($id)->delete();
            return redirect()->route('sales.index')->with('success', 'Sales berhasil dihapus');
        } 
        catch (Exception $e) 
        {
            return redirect()->back()->with('error', 'Gagal hapus sales. Silahkan coba lagi');
        }
    }
}
