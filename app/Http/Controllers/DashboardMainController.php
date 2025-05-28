<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesData;
use Illuminate\Support\Facades\Validator;

class DashboardMainController extends Controller
{
    public function index()
    {
        $salesData = SalesData::all();
        //get the sum of item_a, item_b, item_c, and item_d
        $totalItemA = SalesData::sum('item_a');
        $totalItemB = SalesData::sum('item_b');
        $totalItemC = SalesData::sum('item_c');
        $totalItemD = SalesData::sum('item_d');
        //get the total sales
        $totalSales = $totalItemA + $totalItemB + $totalItemC + $totalItemD;
        

        return view('admin.dashboard', compact('salesData', 'totalSales'));
    }
    public function addSalesData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'salesperson' => 'required|string|max:255',
            'itemA' => 'required|string|max:255',
            'itemB' => 'required|string|max:255',
            'itemC' => 'required|string|max:255',
            'itemC' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $salesData = new SalesData();
        $salesData->salesperson_name = $request->input('salesperson');
        $salesData->item_a = $request->input('itemA');
        $salesData->item_b = $request->input('itemB');
        $salesData->item_c = $request->input('itemC');
        $salesData->item_d = $request->input('itemD');
        $salesData->save();

        return redirect()->route('dashboard')->with('success', 'Sales data added successfully.');

       
    }
    public function deleteSalesData($id)
    {
        $salesData = SalesData::findOrFail($id);
        $salesData->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sales data deleted successfully.'
        ]); 
    }
    public function updateSalesData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'salesperson' => 'required|string|max:255',
            'itemA' => 'required|string|max:255',
            'itemB' => 'required|string|max:255',
            'itemC' => 'required|string|max:255',
            'itemD' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $salesData = SalesData::findOrFail($request->input('id'));
        $salesData->salesperson_name = $request->input('salesperson');
        $salesData->item_a = $request->input('itemA');
        $salesData->item_b = $request->input('itemB');
        $salesData->item_c = $request->input('itemC');
        $salesData->item_d = $request->input('itemD');
        $salesData->save();

        return redirect()->route('dashboard')->with('success', 'Sales data updated successfully.');
    }
}
