@extends ('layouts.app')

@section ('content')
  <h1>管理画面</h1>
  @if (!$keyword_groups)
    <p>キーワードが登録されていません</p>
  @else
    <table class="w-full table-auto">
      <tr>
        <th class="text-base px-4 py-2">キーワード</th>
        <th class="text-base px-4 py-2">検索を行うリポジトリ数</th>
        <th class="text-base px-4 py-2">検索結果</th>
        <th class="text-base px-4 py-2">自動チェック</th>
        <th class="text-base px-4 py-2">チェック日時</th>
      </tr>
      <tbody>
        @foreach ($keyword_groups as $keyword_group)
        <tr>
          <td class="border px-4 py-2">
            <a href="{{ route('keyword.edit', ['keyword' => $keyword_group->id]) }}">{{ $keyword_group->keyword }}</a>
          </td>
          <td class="border px-4 py-2">
            {{ $keyword_group->search_repository_num }}
          </td>
          <td class="border px-4 py-2">
            @if (is_null($keyword_group->check_result))
              <span>-</span>
            @elseif ($keyword_group->check_result)
              <span>成功</span>
            @else
              <span>失敗</span>
            @endif
          </td>
          <td class="border px-4 py-2">
            @if (is_null($keyword_group->auto_check_date))
              <span>-</span>
            @else
              <span>{{ $keyword_group->auto_check_date->format('Y/m/d H:i') }}</span>
            @endif
          </td>
          <td class="border px-4 py-2">
            @if (is_null($keyword_group->updated_at))
              <span>-</span>
            @else
              <span>{{ $keyword_group->updated_at->format('Y/m/d H:i') }}</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="mt-5 d-flex justify-content-center">
      {{ $keyword_groups->links() }}
    </div>
  @endif
@endsection
