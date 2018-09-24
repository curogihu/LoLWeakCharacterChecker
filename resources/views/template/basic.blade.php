<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Album example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/album.css" rel="stylesheet">
  </head>

  <body>
    @yield("template.header")
    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Weak Character Checker</h1>
          <p class="lead text-muted">対象プレイヤーの苦手なチャンピオンを検索するサイトです。</p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-4 mx-auto">
              <div class="card mb-4 shadow-sm">
                <div class="card-body">
                  <p class="card-text">対象サモナーネーム</p>
                  <input style="width:100%;" type="text" name="champion1">
                </div>
                <div class="card-body">
                  <p class="card-text">対象チャンピオン</p>
                  <input style="width:100%;" type="text" name="champion1">
                  <input style="width:100%;" type="text" name="champion2">
                  <input style="width:100%;" type="text" name="champion3">
                  <input style="width:100%;" type="text" name="champion4">
                  <input style="width:100%;" type="text" name="champion5">
                </div>
              </div>

              <input type="submit" name="submit" value="送信">
            </div>
          </div>
        </div>
      </div>
    </main>

    @yield("footer")

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.min.js"></script>
  </body>
</html>