<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\RepeatedQuestions;
use Auth;
use Illuminate\Http\Request;

class RepeatedQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->permissions->manage_mainpage) {
            return abort(403, 'ليس لديك سماحية الوصول الى هذه الصفحة');
        }
        $questions = RepeatedQuestions::all();
        return view('repeatedQuestions.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->permissions->manage_mainpage) {
            return abort(403, 'ليس لديك سماحية الوصول الى هذه الصفحة');

        }
        return view('repeatedQuestions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        // try {
        $question = new RepeatedQuestions();
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->save();
        session()->flash('success', 'تم الاضافة بنجاح');
        return redirect(route('repeated-questions.index'));
        // } catch (\Throwable $th) {
        //     abort(500);
        // } 
    }

    /**
     * Display the specified resource.
     */
    public function show(RepeatedQuestions $repeatedQuestions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepeatedQuestions $repeatedQuestions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RepeatedQuestions $repeatedQuestions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($repeatedQuestions)
    {
        if (!Auth::user()->permissions->manage_mainpage) {
            return abort(403, 'ليس لديك سماحية الوصول الى هذه الصفحة');
        }
        try {
            $repeatedQuestions = RepeatedQuestions::find($repeatedQuestions);

            $repeatedQuestions->delete();
            session()->flash('success', 'تم الحذف بنجاح');
            return redirect(route('repeated-questions.index'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }
}
