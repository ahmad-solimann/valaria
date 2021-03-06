<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.Questionnaires.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $questionnaire = Questionnaire::create([

            'category_id'=> $request->category_id,
            'user_id'=>Auth::user()->id,
            'style_id'=> $request->style_id,
            'project_name'=> $request->name,
            'project_description'=> $request->description,
            'project_address'=> "no address",
            'budget_range'=> $request->budget
        ]);
        if ($request->link1 != null){
            $questionnaire->references()->create([
                'link'=>$request->link1
            ]);
        }
        if ($request->link2 !=null){
            $questionnaire->references()->create([
                'link'=>$request->link2
            ]);
        }
        if ($request->link3 !=null){
            $questionnaire->references()->create([
                'link'=>$request->link3
            ]);
        }

        if ($files =$request->file('files')){
            foreach ($files as $file){
                $fileName = $file->getClientOriginalName();
                $file->move('upload', $fileName);
                $questionnaire->files()->create([
                    'file'=>$fileName
                ]);
            }

        }
        return response()->json(['success'=>'upload form successfully !!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =Auth::user();
        $questionnaire = Questionnaire::with('files')->find($id);
        $questionnaires = Questionnaire::where('user_id',$user->id)->get();


        return view('users.Questionnaires.show',compact(['questionnaire','questionnaires','user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        //
    }
}
