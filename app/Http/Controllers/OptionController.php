<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

/**
 * Class OptionController
 * @package App\Http\Controllers
 */
class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::paginate();

        return view('option.index', compact('options'))
            ->with('i', (request()->input('page', 1) - 1) * $options->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $option = new Option();
        return view('option.create', compact('option'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Option::$rules);

        $option = Option::create($request->all());

        return redirect()->route('options.index')
            ->with('success', 'Option created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $option = Option::find($id);

        return view('option.show', compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $option = Option::find($id);

        return view('option.edit', compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Option $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        request()->validate(Option::$rules);

        $option->update($request->all());

        return redirect()->route('options.index')
            ->with('success', 'Option updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $option = Option::find($id)->delete();

        return redirect()->route('options.index')
            ->with('success', 'Option deleted successfully');
    }
}
