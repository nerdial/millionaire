<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
        $options = Option::with('question')->simplePaginate();

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

        $questions = Question::all()->pluck('title', 'id');

        return view('option.create', [
            'option' => $option,
            'questions' => $questions
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Option::$rules);

        $this->checkCorrectAnswer($request);

        $option = Option::create($request->all());

        return redirect()->route('options.index')
            ->with('success', 'Option created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $option = Option::find($id);

        $questions = Question::all()->pluck('title', 'id');

        return view('option.edit', [
            'option' => $option,
            'questions' => $questions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Option $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        request()->validate(Option::$rules);

        $this->checkCorrectAnswer($request);

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


    public function checkCorrectAnswer(Request $request)
    {
        if ($request->get('is_correct') === '1') {

            $correctAnswer = Option::where([
                'is_correct' => 1,
                'question_id' => $request->get('question_id')
            ])->count();

            if ($correctAnswer) {
                $validator = Validator::make([], []); // Empty data and rules fields
                $validator->errors()->add('is_correct',
                    'This question has already one correct answer');
                throw new ValidationException($validator);
            }
        }

    }
}
