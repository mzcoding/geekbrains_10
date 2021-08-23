@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Новости</h1>
        <a href="{{ route('admin.news.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Добавить новую</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        @include('inc.message')
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>Заколовок</th>
                      <th>Категория</th>
                      <th>Статус</th>
                      <th>Автор</th>
                      <th>Дата добавления</th>
                      <th>Управление</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($newsList as $news)

                      <tr>
                          <td>{{ $news->title }}</td>
                          <td>{{ optional($news->category)->title }}</td>
                          <td>{{ $news->status }}</td>
                          <td>{{ $news->author }}</td>
                          <td> @if($news->updated_at) {{ $news->updated_at }} @else {{ now() }} @endif</td>
                          <td><a href="{{ route('admin.news.edit', ['news' => $news->id]) }}" style="font-size: 12px;">ред.</a> &nbsp;
                              <a href="javascript:;" rel="{{ $news->id }}" class="delete" style="font-size: 12px; color:red;">уд.</a></td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="5">Новостей не найдено</td>
                      </tr>
                  @endforelse
                </tbody>
            </table>

            {{ $newsList->links() }}
        </div>
    </div>
@endsection

@push('js')
  <script type="text/javascript">
       $(function() {
          $(".delete").on('click', function() {
              var id = $(this).attr('rel');
              if(confirm("Подтверждаете удаление записи c ID #" + id + " ?")) {
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type: "DELETE",
                      url: "/admin/news/" + id,
                      dataType: 'json',
                      success: function(response) {
                          alert("Запись была удалена");
                          location.reload();
                      }
                  });
              }
          });

       });
  </script>
@endpush