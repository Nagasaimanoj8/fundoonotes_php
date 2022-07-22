<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Label;
use Illuminate\Http\Request;
use App\Models\Notes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotesAndLabelController extends Controller
{
    /**
     * @OA\Post(
     *   path="/api/addToNotes",
     *   summary="addToNotes",
     *   description="addToNotes",
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"title", "description"},
     *               @OA\Property(property="title", type="string"),
     *               @OA\Property(property="description", type="string"),
     *            ),
     *        ),
     *    ),
     *   @OA\Response(response=201, description="User successfully addedto notes "),
     *   @OA\Response(response=401, description="Invalid notes"),
     * )
     * 
     *
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function addToNotes(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $notes = new Notes();
        $notes->title = $request->input('title');
        $notes->description = $request->input('description');
        $notes->save();
        return response()->json(['data'=>$notes, 'success'=>200]);
    }
     /**
     * @OA\Post(
     *   path="/api/addTolabel",
     *   summary="addTolabel",
     *   description="addTolabel",
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"title", "description"},
     *               @OA\Property(property="title", type="string"),
     *               @OA\Property(property="description", type="string"),
     *            ),
     *        ),
     *    ),
     *   @OA\Response(response=201, description="User successfully addedto notes "),
     *   @OA\Response(response=401, description="Invalid notes"),
     * )
     * 
     *
     * @return \Illuminate\Http\JsonResponse
     */
     

    public function addTolabel(Request $request){
        $request->validate([
            'label' => 'required',
            'notes_id' => 'required'
        ]);

        $label = new Label();
        $label->label = $request->input('label');
        $label->notes_id = $request->input('notes_id');
        $label->save();
        return response()->json(['data'=>$label, 'success'=>200]);
    }
         /**
     * @OA\Post(
     *   path="/api/addTolabel",
     *   summary="addTolabel",
     *   description="addTolabel",
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"title", "description"},
     *               @OA\Property(property="label", type="string"),
     *               @OA\Property(property="notes_id", type="string"),
     *            ),
     *        ),
     *    ),
     *   @OA\Response(response=201, description="User successfully addedto notes "),
     *   @OA\Response(response=401, description="Invalid notes"),
     * )
     * 
     *
     * @return \Illuminate\Http\JsonResponse
     */
     

    public function joinTable(){
        $data = DB::table('notes')->join('label', 'notes.id', '=', 'label.notes_id')
                        ->select('notes.*', 'label.label')->get();
        if(!$data){
            Log::channel('custom')->debug("Table does not exists");
        }
        return $data;
    }
     /**
     * @OA\Post(
     *   path="/api/delete",
     *   summary="delete",
     *   description="addTolabel",
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"userId},
     *               
     *               @OA\Property(property="userId", type="string"),
     *            ),
     *        ),
     *    ),
     *   @OA\Response(response=201, description="User successfully addedto notes "),
     *   @OA\Response(response=401, description="Invalid notes"),
     * )
     * 
     *
     * @return \Illuminate\Http\JsonResponse
     */
     

    public function delete(Request $request){
        $request->validate([
            'userId' => 'required'
        ]);
        $data = DB::table('notes')->join('label', 'notes.id', '=', 'label.notes_id')
                        ->where('notes.id', $request->userId)->delete();

        DB::table('label')->where('notes_id', $request->userId)->delete();

        if(!$data){
            Log::channel('custom')->error("You entered invalid id");
        }
        return $data;
    }

     /**
     * @OA\Post(
     *   path="/api/updateNotes",
     *   summary="updateNotes",
     *   description="updateNotes",
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"title", "description","userId"},
     *               @OA\Property(property="title", type="string"),
     *               @OA\Property(property="userId", type="string"),
     *               @OA\Property(property="description", type="string"),
     *            ),
     *        ),
     *    ),
     *   @OA\Response(response=201, description="User successfully addedto notes "),
     *   @OA\Response(response=401, description="Invalid notes"),
     * )
     * 
     *
     * @return \Illuminate\Http\JsonResponse
     */
     

    public function updateNotes(Request $request,){
        $request->validate([
            'userId' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = DB::table('notes')->where('id', $request->userId)->update(['title'=>$request->title, 'description'=>$request->description]);
        if(!$data){
            Log::channel('custom')->error("You entered invalid id");
        }
        return response()->json(['data'=>$data, 'success'=>200]);
    }

    public function updateLabel(Request $request){
        $request->validate([
            'userId' => 'required',
            'label' => 'required',
            'notes_id' => 'required'
        ]);

        $data = DB::table('label')->where('id', $request->userId)->update(['label'=>$request->label, 'notes_id'=>$request->notes_id]);
        if(!$data){
            Log::channel('custom')->debug("You entered invalid id");
        }
        return response()->json(['data'=>$data, 'success'=>200]);
    }
}
