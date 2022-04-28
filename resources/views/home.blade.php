@extends('layouts.app')

@section('page')
買い物リスト
@endsection

@section('content')
<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ダッシュボード</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3">
</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home"></span>
                在庫管理一覧
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file"></span>
                買い物リスト編集
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                買い物リスト登録
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('stocks') }}">
                <span data-feather="users"></span>
                選択したものを<br>在庫管理画面に登録
              </a>
            </li>
          </ul>

          <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>保存されたレポート</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                今月
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
               前四半期
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                社会的関与
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                年末販売
              </a>
            </li>
          </ul> -->
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">見出し</th>
                <th scope="col">見出し</th>
                <th scope="col">見出し</th>
                <th scope="col">見出し</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1,001</td>
                <td>あお</td>
                <td>交</td>
                <td>小</td>
                <td>記</td>
              </tr>
              <tr>
                <td>1,002</td>
                <td>いね</td>
                <td>鋼</td>
                <td>省</td>
                <td>黄</td>
              </tr>
              <tr>
                <td>1,003</td>
                <td>うた</td>
                <td>抗</td>
                <td>商</td>
                <td>木</td>
              </tr>
              <tr>
                <td>1,004</td>
                <td>えま</td>
                <td>工</td>
                <td>匠</td>
                <td>規</td>
              </tr>
              <tr>
                <td>1,005</td>
                <td>おか</td>
                <td>項</td>
                <td>生</td>
                <td>機</td>
              </tr>
              <tr>
                <td>1,006</td>
                <td>かさ</td>
                <td>孔</td>
                <td>章</td>
                <td>期</td>
              </tr>
              <tr>
                <td>1,007</td>
                <td>きじ</td>
                <td>構</td>
                <td>証</td>
                <td>既</td>
              </tr>
              <tr>
                <td>1,008</td>
                <td>くり</td>
                <td>高</td>
                <td>章</td>
                <td>気</td>
              </tr>
              <tr>
                <td>1,009</td>
                <td>けち</td>
                <td>孝</td>
                <td>少</td>
                <td>基</td>
              </tr>
              <tr>
                <td>1,010</td>
                <td>こま</td>
                <td>功</td>
                <td>将</td>
                <td>貴</td>
              </tr>
              <tr>
                <td>1,011</td>
                <td>さら</td>
                <td>公</td>
                <td>招</td>
                <td>着</td>
              </tr>
              <tr>
                <td>1,012</td>
                <td>しか</td>
                <td>甲</td>
                <td>庄</td>
                <td>樹</td>
              </tr>
              <tr>
                <td>1,013</td>
                <td>すぎ</td>
                <td>候</td>
                <td>性</td>
                <td>来</td>
              </tr>
              <tr>
                <td>1,014</td>
                <td>せみ</td>
                <td>考</td>
                <td>頌</td>
                <td>奇</td>
              </tr>
              <tr>
                <td>1,015</td>
                <td>そと</td>
                <td>講</td>
                <td>勝</td>
                <td>器</td>
              </tr>
            </tbody>
          </table>
        </div><!-- /.table-responsive -->
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- //JavaScriptプラグインの設定など -->
  <!-- アイコン -->
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <!-- グラフ -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <!-- JSの設定ファイル -->
  <script src="dashboard.js"></script>
</body>

</html>
<!-- <div class="container">
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="" class="nav-link active">在庫管理一覧</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link active">買い物リスト編集</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link active">買い物リスト登録</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link active">選択したものを<br>在庫管理画面へ登録する</a>
                        </li>
                    </ul>
                </div>
            </nav>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">名前</th>
                    <th scope="col">個数</th>
                    <th scope="col">期限</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>人参</td>
                    <td>3</td>
                    <td>2022/4/25</td>
                </tr>
                <tr>
                    <td>玉ねぎ</td>
                    <td>1.5</td>
                    <td>2022/4/24</td>
                </tr>
                <tr>
                    <td>ピーマン</td>
                    <td>5</td>
                    <td>2022/4/25</td>
                </tr>

            </tbody>
        </table>
        </div>
    </div>
</div> -->
@endsection