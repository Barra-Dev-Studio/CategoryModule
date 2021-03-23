<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Services\CategoryService       $categoryService
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryService $categoryService)
    {
        $create = $categoryService->store($request);

        return ($create) ? redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan') : back()->with('error', 'Kategori gagal ditambahkan');
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
     * @param  \App\Services\CategoryService $categoryService
     * @return \Illuminate\Http\Response
     */
    public function edit($id, CategoryService $categoryService)
    {
        $data = $categoryService->get($id);

        return view('category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request      $request
     * @param  int                           $id
     * @param  \App\Services\CategoryService $categoryService
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id, CategoryService $categoryService)
    {
        $update = $categoryService->update($request, $id);

        return ($update) ? redirect()->route('category.index')->with('success', 'Kategori berhasil disunting') : back()->with('error', 'Kategori gagal disunting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Services\CategoryService $categoryService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CategoryService $categoryService)
    {
        try {
            DB::beginTransaction();
            $delete = $categoryService->delete($id);
            DB::commit();

            return ($delete) ? redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus') : back()->with('error', 'Kategori gagal dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan, kategori gagal dihapus');
        }
    }

    /**
     * List datatables
     * 
     * @param  \Illuminate\Http\Request      $request
     * 
     * @return json
     */
    public function list(Request $request, CategoryService $categoryService)
    {
        if ($request->ajax()) {
            $data = $categoryService->getAll();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return "<div class='btn-group'>
                        <a class='btn btn-warning btn-sm' href='" . route('category.edit', $data->id) . "'>
                            <i class='anticon anticon-edit'></i>
                        </a>
                        <form action='" . route('category.destroy', $data->id) . "' method='POST'>" . csrf_field() . " " . method_field('DELETE') . "
                            <button class='btn btn-danger btn-sm deleteButton'>
                                <i class='anticon anticon-delete'></i>
                            </button>
                        </form>
                    </div>";
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make('true');
        }
    }
}
