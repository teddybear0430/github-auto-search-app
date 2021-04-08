<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KeywordGroup;
use Illuminate\Http\Request;
use App\Http\Requests\KeywordGroupRequest;
use Illuminate\Support\Facades\Auth;

class KeywordGroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  /**
   * データの新規作成
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.keyword_group.create');
  }

  /**
   * データの保存処理
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(KeywordGroupRequest $request)
  {
    $user_id = Auth::id();

    $KeywordGroup = new KeywordGroup();
    $KeywordGroup->keyword = $request->keyword;
    $KeywordGroup->search_repository_num = $request->search_repository_num;
    $KeywordGroup->user_id = $user_id;

    // データが入力されている時のみ登録処理を行う
    $keyword_memo = $request->keyword_memo;
    $auto_check_date = $request->auto_check_date;

    if ($auto_check_date || $keyword_memo) {
      $KeywordGroup->auto_check_date = $auto_check_date;
      $KeywordGroup->keyword_memo = $keyword_memo;
    }

    $KeywordGroup->save();

    return redirect('/admin');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\KeywordGroup  $keywordGroup
   * @return \Illuminate\Http\Response
   */
  public function show(KeywordGroup $keywordGroup)
  {
      //
  }

  /**
   * データの編集画面
   *
   * @param  \App\Models\KeywordGroup  $keywordGroup
   * @return \Illuminate\Http\Response
   */
  public function edit(int $id)
  {
    $keyword_group = KeywordGroup::findOrFail($id);
    return view('admin.keyword_group.edit', compact('keyword_group'));
  }

  /**
   * データの更新処理
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\KeywordGroup  $keywordGroup
   * @return \Illuminate\Http\Response
   */
  public function update(KeywordGroupRequest $request, int $id)
  {
    $KeywordGroup = KeywordGroup::where('id', $id)->findOrFail($id);

    $KeywordGroup->keyword = $request->keyword;
    $KeywordGroup->search_repository_num = $request->search_repository_num;

    $keyword_memo = $request->keyword_memo;
    $auto_check_date = $request->auto_check_date;

    if ($auto_check_date || $keyword_memo) {
      $KeywordGroup->auto_check_date = $auto_check_date;
      $KeywordGroup->keyword_memo = $keyword_memo;
    }

    $KeywordGroup->save();

    return redirect()->route('keyword.edit', $KeywordGroup);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\KeywordGroup  $keywordGroup
   * @return \Illuminate\Http\Response
   */
  public function destroy(KeywordGroup $keywordGroup)
  {
      //
  }
}
